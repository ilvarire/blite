<?php

namespace App\Livewire\Customer;

use App\Helpers\CartSession;
use App\Mail\OrderPlaced;
use App\Mail\PaymentPending;
use App\Mail\PaymentPendingAdmin;
use App\Models\County;
use App\Models\Coupon;
use App\Models\General;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\ShippingFee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Checkout extends Component
{
    public string $orderType = 'delivery';
    public int $county_id;
    public $state_id;
    public $address;
    public $city;
    public $pickup_location;
    public $pickup_time;
    public $zip_code;
    public $phone_number;
    public $note;
    public $cartItems;
    public $counties;
    public $states = [];
    public float $shippingFee = 0;
    public float $grand_total = 0;
    public float $discount = 0;
    public $coupon, $cart_weight;
    public $paymentMethod = 'transfer';
    public $coupon_id = null;
    public $cart_total = null;
    public function mount()
    {
        $general = General::take(1)->first();
        if (!$general->checkout) {
            return redirect(route('cart'));
        }
        $this->pickup_location = $general->pickup_location;
        $this->pickup_time = $general->pickup_time;
        $this->loadCartItems();
    }
    private function loadCartItems()
    {
        $this->cartItems = CartSession::getCartItemsFromSession();
        $this->counties = County::orderBy('name')->get();
        $this->grand_total = array_sum(array_column($this->cartItems, 'total_amount')) + array_sum(array_column($this->cartItems, 'caution_fee'));
        $this->cart_weight = array_sum(array_column($this->cartItems, 'weight'));
    }
    public function updated($property, $value)
    {
        if ($property == 'county_id') {
            $this->states = ShippingFee::where('county_id', $value)->get();
            $this->state_id = null;
            $this->calculateShipping();
        } elseif ($property == 'state_id') {
            if ($this->county_id && $this->state_id) {
                $this->calculateShipping();
            }
        }
    }
    public function updatedStateId()
    {
        $this->calculateShipping();
    }
    private function calculateShipping()
    {

        if (!$this->county_id || !$this->state_id) return;

        $shippingRule = ShippingFee::where('county_id', $this->county_id)
            ->where('id', $this->state_id)
            ->first();

        if ($shippingRule) {
            $this->shippingFee = $shippingRule->base_fee + ($this->cart_weight * $shippingRule->fee_per_kg);
        } else {
            $this->shippingFee = 0;
        }

        $this->updateTotal();
    }

    public function applyCoupon()
    {
        $this->validate([
            'coupon' => 'required'
        ]);

        $coupon = Coupon::where('code', $this->coupon)
            ->whereDate('end_date', '>=', now())
            ->first();

        if (!$coupon) {
            $this->coupon_id = null;
            LivewireAlert::title('Coupon')
                ->text('invalid or expired.')
                ->error()
                ->toast()
                ->position('center')
                ->show();
            $this->discount = 0;
        } else {
            $this->coupon_id = $coupon->id;
            $this->discount = $this->grand_total * ($coupon->discount_percentage / 100);
            LivewireAlert::title('Coupon')
                ->text('added successfully.')
                ->success()
                ->toast()
                ->position('center')
                ->show();
        }

        $this->updateTotal();
    }

    private function  updateTotal()
    {
        $this->cart_total = max(0, $this->grand_total + $this->shippingFee - $this->discount);
    }

    private function confirmCoupon($coupon)
    {
        if ($coupon === '') {
            $this->coupon_id = null;
            $discount = 0;
            return $discount;
        }
        $coupon = Coupon::where('code', $this->coupon)
            ->whereDate('end_date', '>=', now())
            ->first();
        if (!$coupon) {
            $this->coupon_id = null;
            $discount = 0;
            return $discount;
        } else {
            $this->coupon_id = $coupon->id;
            $discount = $this->grand_total * ($coupon->discount_percentage / 100);
            return $discount;
        }
    }
    private function getRandomLetters($length = 2)
    {
        return substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);
    }
    public function checkout()
    {
        $this->loadCartItems();
        if (count($this->cartItems) < 1) {
            LivewireAlert::title('Cart Empty')
                ->text('please add items to cart.')
                ->error()
                ->toast()
                ->position('center')
                ->show();
            return;
        }
        $general = General::take(1)->first();
        if (!$general->checkout) {
            LivewireAlert::title('Checkout Paused')
                ->text('Cannot checkout at the moment. Checkouts would resume soon')
                ->error()
                ->toast()
                ->position('center')
                ->show();
            return;
        }

        $this->validate([
            'address' => 'required_if:orderType,delivery|string|max:255|nullable',
            'city' => 'required_if:orderType,delivery|string|max:40|nullable',
            'phone_number' => 'required|string|max:20',
            'zip_code' => 'required_if:orderType,delivery|string|max:30|nullable',
            'county_id' => 'required_if:orderType,delivery|integer|exists:counties,id|nullable',
            'state_id' => 'required_if:orderType,delivery|max:30|exists:shipping_fees,id|nullable',
            'note' => 'nullable|max:600',
            'orderType' => 'required|in:delivery,pickup',
            'paymentMethod' => 'required|in:transfer',
            'coupon' => 'nullable|string|max:50',
        ], [
            'phone_number.required' => 'Phone number is required.',
            'phone_number.string' => 'Phone number must be a valid string.',
            'phone_number.max' => 'Phone number cannot exceed 20 characters.',

            'zip_code.required' => 'Post code is required.',
            'zip_code.string' => 'Post code must be a valid string.',
            'zip_code.max' => 'Post code cannot exceed 30 characters.',

            'county_id.required' => 'Please select a county.',
            'county_id.integer' => 'Invalid county selection.',
            'county_id.exists' => 'Selected county does not exist.',

            'state_id.required' => 'Please select a state.',
            'state_id.max' => 'State identifier is too long.',
            'state_id.exists' => 'Selected state is not valid.',

            'note.max' => 'Note cannot exceed 600 characters.',

            'orderType.required' => 'Please select an order type.',
            'orderType.in' => 'Order type must be either "delivery" or "pickup".',

            'paymentMethod.required' => 'Please select a payment method.',
            'paymentMethod.in' => 'Selected payment method is not supported.',
        ]);

        $this->confirmCoupon($this->coupon);
        if ($this->orderType === 'delivery') {
            $this->calculateShipping();
        }
        $strg = $this->getRandomLetters();

        try {
            if ($this->orderType === 'delivery') {
                $shippingAddress = ShippingAddress::create([
                    'user_id' => Auth::user()->id,
                    'county_id' => $this->county_id,
                    'shipping_fee_id' => $this->state_id,
                    'city' => $this->city,
                    'address' => $this->address,
                    'phone_number' => $this->phone_number,
                    'zip_code' => $this->zip_code
                ]);
                $AddressId = $shippingAddress->id;
            } else {
                $AddressId = null;
            }
            $order = Order::create([
                'reference' => 'ord-' . $strg . date('dHis'),
                'user_id' => Auth::user()->id,
                'order_type' => $this->orderType,
                'shipping_address_id' => $AddressId,
                'total_price' => $this->grand_total,
                'note' => $this->note ?? null,
                'phone_number' => $this->phone_number,
                'coupon_id' => $this->coupon_id ?? null
            ]);

            foreach ($this->cartItems as $item) {
                if ($item['product_type'] === 'food') {
                    $order->items()->create([
                        'product_type' => 'food',
                        'product_id' => $item['food_id'],
                        'size_id' => $item['size_id'],
                        'size' => $item['size'],
                        'quantity' => $item['quantity'],
                        'weight' => $item['weight'],
                        'unit_price' => $item['unit_price'],
                        'total' => $item['total_amount']
                    ]);
                } elseif ($item['product_type'] === 'equipment') {
                    $order->items()->create([
                        'product_type' => 'equipment',
                        'product_id' => $item['equipment_id'],
                        'rental_start' => $item['rental_start'],
                        'rental_duration' => $item['rental_duration'],
                        'rental_end' => $item['rental_end'],
                        'caution_fee' => $item['caution_fee'],
                        'quantity' => $item['quantity'],
                        'weight' => $item['weight'],
                        'unit_price' => $item['unit_price'],
                        'total' => $item['total_amount']
                    ]);
                }
            }
            CartSession::clearCartItems();
            $admin = User::where('role', 1)->value('email');
            if ($admin) {
                Mail::to($admin)->send(
                    new PaymentPendingAdmin($order)
                );
            }
            Mail::to(Auth::user()->email)->send(
                new PaymentPending($order)
            );
            return redirect(route('pay', ['reference' => $order->reference]));
        } catch (\Exception $e) {
            LivewireAlert::title('Error')
                ->text($e->getMessage())
                ->error()
                ->toast()
                ->position('center')
                ->show();
            return;
        }
    }
    public function render()
    {
        return view('livewire.customer.checkout');
    }
}

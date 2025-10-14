<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Food;
use App\Models\General;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCard extends Component
{
    public $cartItems = [];
    public function mount($cartItems)
    {
        $this->cartItems = $cartItems;
    }

    public function decreaseQuantity($product_type, $id)
    {
        if ($product_type === 'food') {
            $this->cartItems = CartManagement::decrementFoodQuantity($id);
        } else {
            $this->cartItems = CartManagement::decrementEquipmentQuantity($id);
        }

        $cart_count = count($this->cartItems);
        // $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);
        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . 'Quantity' . '</h4>')
            ->text('Updated successfully.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }

    public function increaseQuantity($product_type, $id)
    {
        if ($product_type === 'food') {
            $this->cartItems = CartManagement::incrementFoodQuantity($id);
        } else {
            $this->cartItems = CartManagement::incrementEquipmentQuantity($id);
        }

        $cart_count = count($this->cartItems);
        // $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);
        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . 'Quantity' . '</h4>')
            ->text('Updated successfully.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }

    public function removeFoodFromCart($food_id)
    {
        $cart_items = CartManagement::removeFoodFromCart($food_id);
        $cart_count = count($cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count);
        $this->dispatch('update-cart');
    }

    #[On('update-cart-count')]
    public function updateCartCount($cart_count)
    {
        // dd($cart_count);
        // $this->cart_count = $cart_count;
        $this->cartItems = CartManagement::getCartItemsFromCookie();
    }

    public function removeEquipmentFromCart($equipment_id)
    {
        $cart_items = CartManagement::removeEquipmentFromCart($equipment_id);
        $cart_count = count($cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count);
        $this->dispatch('update-cart');
    }
    public function render()
    {
        $general = General::take(1)->first();
        return view('livewire.customer.cart-card', ['checkout' => $general->checkout]);
    }
}

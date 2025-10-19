<?php

namespace App\Livewire\Customer;

use App\Models\Banking;
use App\Models\General;
use App\Models\Order;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentCard extends Component
{
    public $bankName;
    public $amount;
    public $accountName;
    public $sortCode;
    public $reference;
    public $accountNumber;

    public function mount($reference, $amount)
    {
        $this->assignValues();
        $this->$reference = $reference;
        $this->amount = $amount;
    }
    private function assignValues()
    {
        $data = Banking::take(1)->first();
        $this->bankName = $data->bank_name;
        $this->sortCode = $data->sort_code;
        $this->accountName = $data->account_name;
        $this->accountNumber = $data->account_number;
    }
    public function cancelTransfer()
    {
        $order = Order::where('reference', $this->reference)->first();

        // If order doesn't exist, abort 404
        if (!$order) {
            abort(404, 'Order not found');
        }

        // If the authenticated user does not own the order, abort 403
        if ($order->user_id !== Auth::id()) {
            abort(404, 'Order not found');
        }
        if ($order->payment_status === 'pending') {
            $order->status = 'cancelled';
            $order->payment_status = 'failed';
            $order->save();

            return redirect(route('home'));
        }
    }

    public function transferDone()
    {
        return redirect(route('order.details', $this->reference));
    }
    public function render()
    {
        return view('livewire.customer.payment-card');
    }
}

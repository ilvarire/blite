<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderInfo extends Component
{
    public $reference;
    public $order;
    public function mount($reference)
    {
        $this->reference = $reference;
        $order = Order::with('items.product', 'shippingAddress')
            ->where('reference', $reference)
            ->where('user_id', Auth::user()->id)->firstOrFail();
        $this->order = $order;
    }
    public function render()
    {
        return view('livewire.customer.order-info');
    }
}

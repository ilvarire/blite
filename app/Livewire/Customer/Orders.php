<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    protected $queryString = [];
    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->orderByDesc('id')->simplePaginate(10);
        return view('livewire.customer.orders', ['orders' => $orders]);
    }
}

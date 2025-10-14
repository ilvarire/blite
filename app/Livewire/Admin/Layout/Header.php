<?php

namespace App\Livewire\Admin\Layout;

use App\Models\FoodReview;
use App\Models\Order;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $pendingOrders = Order::where('status', 'processed')->count();
        $pendingReviews = FoodReview::where('status', 'pending')->count();
        return view('livewire.admin.layout.header', [
            'pendingOrders' => $pendingOrders,
            'pendingReviews' => $pendingReviews
        ]);
    }
}

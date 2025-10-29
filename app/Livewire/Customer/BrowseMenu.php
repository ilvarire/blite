<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Models\Food;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class BrowseMenu extends Component
{
    public function addFoodToCart($food_id)
    {
        $food = Food::with('prices')
            ->where('id', $food_id)->firstOrFail();
        $size_id = $food->prices->first()->size_id;
        $quantity = 1;
        $cart_count = CartManagement::addFoodItemToCart($food_id, $size_id, $quantity);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);
        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . $food->name . '</h4>')
            ->text('Added to Cart.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }
    public function render()
    {
        $foods = Food::with('prices')
            ->whereHas('category', function ($query) {
                $query->where('slug', 'quick-meal');
            })
            ->take(6)
            ->get();
        return view('livewire.customer.browse-menu', [
            'foods' => $foods
        ]);
    }
}

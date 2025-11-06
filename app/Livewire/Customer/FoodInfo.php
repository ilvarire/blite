<?php

namespace App\Livewire\Customer;

use App\Helpers\CartSession;
use App\Models\Food;
use App\Models\FoodPrice;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class FoodInfo extends Component
{
    public $food;
    public int $quantity = 1;
    public $foodPrices = [];
    public $selectedSize = null;


    public function mount($food)
    {
        $this->food = $food;
        $this->selectedSize[$food->id] = $food->prices->first()->size_id ?? null;
    }
    public function updatedSelectedSize($value)
    {
        $foodPrice = FoodPrice::where('size_id', $value)
            ->where('food_id', $this->food->id)
            ->first();

        if ($foodPrice) {
            $this->foodPrices[$this->food->id] = $foodPrice->price;
        }
    }

    public function addFoodToCart($food_id, $size_id)
    {
        $this->quantity = is_int($this->quantity) && $this->quantity > 1 && $this->quantity < 1000
            ? $this->quantity
            : 1;
        $quantity = $this->quantity;
        $food = Food::with('prices')
            ->where('id', $food_id)->firstOrFail();

        $selectedSize = $food->prices->where('size_id', $size_id)->first();

        if (!$selectedSize) {
            $selectedSize = $food->prices->first();
            $size_id = $selectedSize->size_id;
        }

        $cart_count = CartSession::addFoodItemToCart($food_id, $size_id, $quantity);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);
        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . $food->name . '</h4>')
            ->text('Added to Cart.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // Increase quantity method
    public function increaseQuantity()
    {
        if ($this->quantity < 1000) {
            $this->quantity++;
        }
    }
    public function render()
    {
        return view('livewire.customer.food-info');
    }
}

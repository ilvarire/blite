<?php

namespace App\Livewire\Customer;

use App\Helpers\CartSession;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public int $cart_count = 0;
    public $cart_items = [];
    public $cart_total = 0;
    public function mount()
    {
        $this->cart_count = count(CartSession::getCartItemsFromSession());
        $this->cart_items = CartSession::getCartItemsFromSession();
        $this->cart_total = CartSession::calculateGrandTotal($this->cart_items);
    }

    #[On('update-cart-count')]
    public function updateCartCount($cart_count)
    {
        // dd($cart_count);
        $this->cart_count = $cart_count;
        $this->cart_items = CartSession::getCartItemsFromSession();
        $this->cart_total = CartSession::calculateGrandTotal($this->cart_items);
    }

    public function removeFoodFromCart($food_id)
    {
        $cart_items = CartSession::removeFoodFromCart($food_id);
        $cart_count = count($cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count);
        $this->dispatch('update-cart');
    }

    public function removeEquipmentFromCart($equipment_id)
    {
        $cart_items = CartSession::removeEquipmentFromCart($equipment_id);
        $cart_count = count($cart_items);
        $this->dispatch('update-cart-count', cart_count: $cart_count);
        $this->dispatch('update-cart');
    }
    public function render()
    {
        return view('livewire.customer.cart');
    }
}

<?php

namespace App\Livewire\Customer;

use App\Helpers\CartSession;
use App\Models\Equipment;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Equipments extends Component
{
    public function addEquipmentToCart($equipment_id)
    {
        $equipment = Equipment::with('images')
            ->where('id', $equipment_id)->firstOrFail();


        $rental_start = Carbon::tomorrow()->toDateString();
        $quantity = 1;
        $duration = 24;
        $cart_count = CartSession::addEquipmentToCart($equipment_id, $rental_start, $duration, $quantity);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);

        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . $equipment->name . '</h4>')
            ->text('Added to Cart.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }
    public function render()
    {
        $equipments = Equipment::with('images')->where('is_featured', true)
            ->orderBy('id', 'asc')->take(6)
            ->get();
        return view('livewire.customer.equipments', [
            'equipments' => $equipments
        ]);
    }
}

<?php

namespace App\Livewire\Customer;

use App\Helpers\CartSession;
use App\Models\Equipment;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class EquipmentCard extends Component
{
    use WithPagination;

    #[Validate('nullable|regex:/^[a-zA-Z0-9\s\-_]+$/')]
    public $search = '';

    public int $quantity = 1;
    public int $duration = 24;
    public $rental_start;

    public function addEquipmentToCart($equipmentId, $rental_start = "", $duration = 24, $quantity = 1)
    {
        try {
            $equipment = Equipment::findOrFail($equipmentId);
            $this->validateCartInputs($rental_start, $duration, $quantity);

            $rental_start = $this->setRentalStart($rental_start);

            $cart_count = CartSession::addEquipmentToCart($equipment->id, $rental_start, $duration, $quantity);
            $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);

            LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . $equipment->name . '</h4>')
                ->text('Added to Cart.')
                ->success()
                ->toast()
                ->position('center')
                ->show();
        } catch (\Exception $e) {
            LivewireAlert::title('Error')
                ->text($e->getMessage())
                ->error()
                ->toast()
                ->position('center')
                ->show();
        }
    }

    private function setRentalStart($rental_start)
    {
        // Get tomorrow's date (ignoring time)
        $tomorrow = Carbon::tomorrow()->toDateString();

        // If rental_start is provided, parse and validate it
        if ($rental_start) {
            $rental_start = Carbon::parse($rental_start)->toDateString();

            // Validate that rental_start is not less than tomorrow
            if ($rental_start < $tomorrow) {
                throw new \Exception('Rental date must be at least tomorrow.');
            }

            // Validate that rental_start is not more than 150 days from tomorrow
            $max_rental_date = Carbon::tomorrow()->addDays(150)->toDateString();
            if ($rental_start > $max_rental_date) {
                throw new \Exception('Rental date must be within 150 days from tomorrow.');
            }
        } else {
            // If rental_start is not defined, default it to tomorrow's date
            $rental_start = $tomorrow;
        }

        return $rental_start;
    }

    private function validateCartInputs($rental_start, $duration, $quantity)
    {
        // Validate rental_start, duration, and quantity inputs
        if ($rental_start) {
            $rental_start = Carbon::parse($rental_start)->toDateString();
            $this->setRentalStart($rental_start); // Validate rental_start
        }

        // Validate duration (should be a positive integer)
        if (!is_int($duration) || $duration <= 0) {
            throw new \Exception('Duration must be a positive integer in hours.');
        }

        // Validate quantity (between 1 and 100)
        if (!is_int($quantity) || $quantity < 1 || $quantity > 100) {
            $quantity = 1; // Default to 1 if invalid
        }
    }
    public function render()
    {
        $equipments = Equipment::query()
            ->with('images') // Ensure 'images' relationship is loaded
            ->when($this->search, function ($q) {
                // Only apply the search filter if a search term exists
                $term = '%' . $this->search . '%';
                $q->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->simplePaginate(24);
        return view('livewire.customer.equipment-card', [
            'equipments' => $equipments
        ]);
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class Bookings extends Component
{
    use WithPagination;

    public $search = null;

    public function render()
    {
        $bookings = Booking::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.admin.bookings', ['bookings' => $bookings]);
    }
}

<?php

namespace App\Livewire\Customer;

use App\Models\Gallery;
use Livewire\Component;

class EventGallery extends Component
{
    public function render()
    {
        $events = Gallery::with('images')->where('is_featured', true)
            ->orderBy('id', 'asc')->take(7)
            ->get();
        return view('livewire.customer.event-gallery', [
            'events' => $events
        ]);
    }
}

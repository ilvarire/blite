<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class GalleryInfo extends Component
{
    public $gallery;
    public function mount($gallery)
    {
        $this->gallery = $gallery;
    }
    public function render()
    {
        return view('livewire.customer.gallery-info');
    }
}

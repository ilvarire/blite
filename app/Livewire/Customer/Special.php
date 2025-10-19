<?php

namespace App\Livewire\Customer;

use App\Models\Category;
use Livewire\Component;

class Special extends Component
{
    public function render()
    {
        $categories = Category::select('name', 'id', 'image_url', 'slug')
            ->where('is_featured', true)->take(4)->get();
        return view('livewire.customer.special', [
            'categories' => $categories
        ]);
    }
}

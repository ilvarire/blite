<?php

namespace App\Livewire\Customer;

use App\Models\Gallery;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryCard extends Component
{
    use WithPagination;

    #[Validate('nullable|regex:/^[a-zA-Z0-9\s\-_]+$/')]
    public $search = '';
    public function render()
    {
        $galleries = Gallery::query()
            ->with('images') // Ensure 'images' relationship is loaded
            ->when($this->search, function ($q) {
                // Only apply the search filter if a search term exists
                $term = '%' . $this->search . '%';
                $q->where(function ($query) use ($term) {
                    $query->where('title', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->simplePaginate(12);
        return view('livewire.customer.gallery-card', [
            'galleries' => $galleries
        ]);
    }
}

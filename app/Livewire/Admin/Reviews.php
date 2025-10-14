<?php

namespace App\Livewire\Admin;

use App\Models\FoodReview;
use App\Models\Food;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Reviews extends Component
{
    public $selectedStatus = '';
    public $selectedFood = '';
    public $comment = null;
    public $rating = null;
    public $status = null;
    public $reviewId = null;
    protected $queryString = [
        'selectedStatus' => ['except' => ''],
        'selectedFood' => ['except' => '']
    ];
    #[On('edit-review')]
    public function confirmingEdit($id)
    {
        $review = FoodReview::with('user', 'food')
            ->where('id', $id)
            ->firstOrFail();

        $this->rating = $review->rating;
        $this->comment = $review->comment;
        $this->status = $review->status;
        $this->reviewId = $review->id;
    }

    public function updateEquipment()
    {
        $review = FoodReview::findOrFail($this->reviewId);
        $validated = $this->validate([
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        $review->update([
            'status' => $validated['status']
        ]);

        Flux::modal('edit-review')->close();
        return redirect()->route('admin.reviews')->with('success', 'Review status updated');
    }

    #[On('delete-review')]
    public function confirmingDelete($id)
    {
        $this->reviewId = $id;
    }
    public function deleteEquipment()
    {
        $review = FoodReview::findOrFail($this->reviewId);
        $review->delete();
        Flux::modal('delete-review')->close();
        return redirect()->route('admin.reviews')->with('success', 'deleted successfully');
    }
    public function render()
    {
        $reviews = FoodReview::with(['user', 'food'])
            ->when($this->selectedStatus, fn($q) => $q->where('status', $this->selectedStatus))
            ->when($this->selectedFood, fn($q) => $q->where('food_id', $this->selectedFood))
            ->latest()->paginate(20);

        $foods = Food::select('id', 'name')->orderBy('name')->get();
        return view('livewire.admin.reviews', [
            'reviews' => $reviews,
            'foods' => $foods
        ]);
    }
}

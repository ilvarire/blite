<?php

namespace App\Livewire\Customer;

use App\Models\FoodReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class FoodReviews extends Component
{
    public $food;
    public $reviews;

    public int $rating = 0;
    public string $message = '';
    public $canReview = false;
    public function mount($food)
    {
        $this->food = $food;
        $this->getReviews();

        if (Auth::check()) {
            $this->canReview = $this->userCanReview(Auth::id(), $this->food->id);
        }
    }
    private function getReviews()
    {
        $userId = Auth::id();
        $this->reviews = FoodReview::with('user')
            ->where('food_id', $this->food->id)
            ->where(function ($query) use ($userId) {
                $query->where('status', 'approved');

                // If user is logged in, also include their own reviews (even if not approved)
                if ($userId) {
                    $query->orWhere(function ($q) use ($userId) {
                        $q->where('user_id', $userId)
                            ->where('food_id', $this->food->id);
                    });
                }
            })
            ->get();
    }
    protected function userCanReview($userId, $foodId): bool
    {
        return DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('order_items.product_id', $foodId)
            ->where('orders.status', 'completed')
            ->exists();
    }

    public function submitReview()
    {
        $this->validate([
            'message' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $existingReview = FoodReview::where('user_id', Auth::user()->id)
            ->where('food_id', $this->food->id)
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $this->rating,
                'comment' => $this->message,
                'status' => 'pending',
            ]);
        } else {
            FoodReview::create([
                'user_id' => Auth::id(),
                'food_id' => $this->food->id,
                'comment' => $this->message,
                'rating' => $this->rating,
            ]);
        }

        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . 'Thanks' . '</h4>')
            ->text('for your review.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
        $this->getReviews();
        $this->reset('message', 'rating');
    }
    public function render()
    {
        return view('livewire.customer.food-reviews');
    }
}

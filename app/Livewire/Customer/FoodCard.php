<?php

namespace App\Livewire\Customer;

use App\Helpers\CartSession;
use App\Models\Category;
use App\Models\Food;
use App\Models\FoodPrice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class FoodCard extends Component
{
    use WithPagination;

    #[Validate('nullable|regex:/^[a-zA-Z0-9\s\-_]+$/')]
    public $search = '';
    public $categoriesQuery = '';
    public $categories = [];
    public $sort = 'asc';
    public $selectedSize = null;
    public $selectedCategory = '';
    public $foodPrices = [];
    public $page = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoriesQuery' => ['as' => 'categories', 'except' => ''],
        'sort' => ['except' => 'asc'],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        if ($this->categoriesQuery) {
            $validNames = Category::pluck('name')->map(fn($n) => strtolower($n))->toArray();
            $value = strtolower($this->categoriesQuery);

            if (in_array($value, $validNames)) {
                $this->selectedCategory = $value;
            } else {
                // Invalid value in query string — ignore it
                $this->selectedCategory = '';
                $this->categoriesQuery = '';
            }
        }

        $foods = Food::with('prices')->get();
        foreach ($foods as $food) {
            $this->selectedSize[$food->id] = $food->prices->first()->size_id ?? null;
        }
    }

    public function toggleCategory($categoryName)
    {
        if (strtolower($categoryName) === 'all') {
            // Reset to show all categories
            $this->selectedCategory = '';
            $this->categoriesQuery = '';
        } elseif ($this->selectedCategory === strtolower($categoryName)) {
            // Clicking the same category again resets filter
            $this->selectedCategory = '';
            $this->categoriesQuery = '';
        } else {
            // Apply category filter
            $this->selectedCategory = strtolower($categoryName);
            $this->categoriesQuery = strtolower($categoryName);
        }

        $this->resetPage();
    }


    public function updatedSort($value)
    {
        if ($value === true) {
            $this->sort = 'desc';
        } else {
            $this->sort = 'asc';
        }
        $this->sort = $this->validateSort($this->sort);

        $this->resetPage();
    }

    private function validateSort($value): string
    {
        return in_array(strtolower($value), ['asc', 'desc']) ? strtolower($value) : 'asc';
    }

    public function updatedSelectedSize($value, $foodId)
    {
        $foodPrice = FoodPrice::where('size_id', $value)
            ->where('food_id', $foodId)
            ->first();
        if ($foodPrice) {
            $this->foodPrices[$foodId] = $foodPrice->price;
        }
    }

    public function addFoodToCart($food_id, $size_id)
    {
        $food = Food::with('prices')
            ->where('id', $food_id)->firstOrFail();

        $selectedSize = $food->prices->where('size_id', $size_id)->first();

        if (!$selectedSize) {
            $selectedSize = $food->prices->first();
            $size_id = $selectedSize->size_id;
        }
        $quantity = 1;
        $cart_count = CartSession::addFoodItemToCart($food_id, $size_id, $quantity);
        $this->dispatch('update-cart-count', cart_count: $cart_count)->to(Cart::class);
        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . $food->name . '</h4>')
            ->text('Added to Cart.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }

    public function render()
    {
        $foods = Food::query()
            ->with(['prices', 'category'])
            ->when($this->search, function ($q) {
                $term = '%' . $this->search . '%';
                $q->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('description', 'like', $term);
                });
            })
            ->when($this->selectedCategory, function ($q) {
                $q->whereHas('category', function ($subQuery) {
                    $subQuery->where(DB::raw('LOWER(name)'), $this->selectedCategory);
                });
            })
            ->join('food_prices', 'food.id', '=', 'food_prices.food_id')
            ->select('food.*', DB::raw('MIN(food_prices.price) as min_price'))
            ->groupBy(
                'food.id',
                'food.name',
                'food.slug',
                'food.description',
                'food.category_id',
                'food.created_at',
                'food.image_url',
                'food.is_available',
                'food.is_special',
                'food.is_featured',
                'food.updated_at'
            )
            ->orderBy('min_price', $this->sort)
            ->simplePaginate(24);

        $allCategories = Category::orderBy('name')->get();
        return view('livewire.customer.food-card', [
            'foods' => $foods,
            'categoriesList' => $allCategories
        ]);
    }
}

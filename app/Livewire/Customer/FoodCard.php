<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
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
        // If coming from URL, explode categoriesQuery into categories array
        if ($this->categoriesQuery) {
            $this->categories = $this->validateCategoryNames(
                explode(',', strtolower($this->categoriesQuery))
            );
        }

        $foods = Food::with('prices')->get();
        foreach ($foods as $food) {
            // Set the default selected size for each food item (first size by default)
            $this->selectedSize[$food->id] = $food->prices->first()->size_id ?? null;
        }
    }

    public function updatedCategories()
    {
        $this->categories = $this->validateCategoryNames($this->categories);
        $this->categoriesQuery = implode(',', $this->categories); // ← This updates the URL
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

    private function validateCategoryNames(array $values): array
    {
        $validCategories = Category::pluck('name')->map(fn($name) => strtolower($name))->toArray();

        return array_values(array_filter($values, function ($val) use ($validCategories) {
            return in_array(strtolower(trim($val)), $validCategories);
        }));
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
        $cart_count = CartManagement::addFoodItemToCart($food_id, $size_id, $quantity);
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
            ->when(count($this->categories), function ($q) {
                $q->whereHas('category', function ($subQuery) {
                    $subQuery->whereIn(DB::raw('LOWER(name)'), array_map('strtolower', $this->categories));
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
            ->simplePaginate(12);

        $allCategories = Category::orderBy('name')->get();
        return view('livewire.customer.food-card', [
            'foods' => $foods,
            'categoriesList' => $allCategories
        ]);
    }
}

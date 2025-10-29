<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food as ModelsFood;
use App\Models\FoodPrice;
use App\Models\Size;
use Flux\Flux;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class Food extends Component
{
    use WithPagination, WithFileUploads;

    public $search = null;
    public $name = null;
    public $foodId = null;
    public $description = null;
    public $category_id = null;
    public $is_special = null;
    public $is_available = null;
    public $is_featured = null;
    public $existingImage = null;
    public $prices = [];
    public $sizes = [];
    public $image = null;
    public $selectedCategory = null;

    public function mount()
    {
        $this->sizes = $this->getAllSizes();
    }

    #[On('edit-food')]
    public function confirmingEdit($food)
    {
        $food = ModelsFood::with('prices')
            ->where('slug', $food)
            ->firstOrFail();

        $this->name = $food->name;
        $this->description = $food->description;
        $this->existingImage = $food->image_url;
        $this->category_id = $food->category->id;
        $this->is_available = $food->is_available;
        $this->is_special = $food->is_special;
        $this->is_featured = $food->is_featured;
        $this->foodId = $food->id;

        foreach ($this->sizes as $size) {
            $existing = $food->prices->where('size_id', $size->id)->first();
            $this->prices[$size->id]['price'] = $existing ? $existing->price : null;
            $this->prices[$size->id]['weight'] = $existing ? $existing->weight : null;
        }
    }

    public function updateFood()
    {
        $food = ModelsFood::findOrFail($this->foodId);

        $this->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:100',
                Rule::unique('food', 'name')->ignore($this->foodId),
            ],
            'description' => [
                'required',
                'string',
                'min:5',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'prices' => [
                'required',
                'array'
            ],
            'prices.*' => [
                'required',
                'array'
            ],
            'prices.*.price' => [
                'numeric',
                'nullable',
                'required_with:prices.*.weight'
            ],
            'prices.*.weight' => [
                'numeric',
                'nullable',
                'required_with:prices.*.price'
            ],
            'is_available' => [
                'boolean',
            ],
            'is_special' => [
                'boolean',
            ],
            'is_featured' => [
                'boolean',
            ],
            'image' => [
                'nullable',
                'image',
                'max:5120',
            ],
        ], [
            'name.required' => 'The food name is required.',
            'name.regex' => 'The name may only contain letters, numbers, and spaces.',
            'name.max' => 'The name must not be greater than 100 characters.',
            'name.unique' => 'This food name already exists.',

            'description.required' => 'A description is required.',
            'description.string' => 'The description must be a string.',
            'description.min' => 'The description must be at least 5 characters long.',

            'prices.required' => 'At least one price option is required.',
            'prices.array' => 'The prices field must be an array.',

            'prices.*.required' => 'Food price must be included.',

            'prices.*.price.numeric' => 'Each price must be a number.',
            'prices.*.price.required_with' => 'You must provide a price for each weight.',

            'prices.*.weight.numeric' => 'Each weight must be a number.',
            'prices.*.weight.required_with' => 'You must provide a weight for each price.',

            'category_id.required' => 'A category is required.',
            'category_id.exists' => 'The selected category is invalid.',

            'image.required' => 'An image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.max' => 'The image must not be larger than 5MB.',
        ]);


        $food->update([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'is_available' => $this->is_available,
            'is_special' => $this->is_special,
            'is_featured' => $this->is_featured
        ]);

        if ($this->image) {
            $manager = ImageManager::withDriver(new Driver);
            $img = $manager->read($this->image->getRealPath());
            $width = $img->width();
            $height = $img->height();

            $expectedRatio = 5 / 3;
            $actualRatio = $width / $height;
            $tolerance = 0.01;

            if (abs($actualRatio - $expectedRatio) > $tolerance) {
                $this->addError("image", "Image must have a 5:3 aspect ratio.");
                return;
            }

            if ($food->image_url && File::exists(public_path($food->image_url))) {
                File::delete(public_path($food->image_url));
            }

            $path = $this->image->store('food', 'public');
            $food->update(['image_url' => $path]);
        }

        foreach ($this->prices as $sizeId => $data) {
            $price = $data['price'] ?? null;
            $weight = $data['weight'] ?? null;

            if (($price !== null && $price !== '') || ($weight !== null && $weight !== '')) {
                // Create or update if either price or weight is provided
                FoodPrice::updateOrCreate(
                    [
                        'food_id' => $food->id,
                        'size_id' => $sizeId
                    ],
                    [
                        'price' => $price,
                        'weight' => $weight
                    ]
                );
            } else {
                // Delete if both price and weight are null/empty
                FoodPrice::where('food_id', $food->id)
                    ->where('size_id', $sizeId)
                    ->delete();
            }
        }

        Flux::modal('edit-food')->close();
        return redirect()->route('admin.food')->with('success', 'Food updated');
    }

    #[On('delete-food')]
    public function confirmingDelete($id)
    {
        $this->foodId = $id;
    }

    public function deleteFood()
    {
        $food = ModelsFood::findOrFail($this->foodId);
        if ($food->image_url && File::exists(public_path($food->image_url))) {
            File::delete(public_path($food->image_url));
        }
        $food->delete();
        Flux::modal('delete-food')->close();
        return redirect()->route('admin.food')->with('success', 'deleted successfully');
    }

    public function getAllCategories()
    {
        return Category::all();
    }
    public function getAllSizes()
    {
        return Size::all();
    }
    public function render()
    {
        $query = ModelsFood::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if (!empty($this->selectedCategory)) {
            $query->where('category_id', $this->selectedCategory);
        }

        $categories = $this->getAllCategories();
        $food = $query->with('prices.size', 'category')->latest()->paginate(10);

        return view('livewire.admin.food', [
            'categories' => $categories,
            'foods' => $food
        ]);
    }
}

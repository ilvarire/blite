<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Food;
use App\Models\FoodPrice;
use App\Models\Size;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class AddFood extends Component
{
    use WithFileUploads;
    public $name = null;
    public $description = null;
    public $category_id = null;
    public $image = null;
    public $prices = [];

    protected function unmask($value)
    {
        return (float) str_replace([',', ' '], '', $value);
    }
    public function storeFood()
    {

        $validated = $this->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:100|unique:food,name',
            'description' => 'required|string|min:5',
            'prices' => 'required|array',
            'prices.*' => 'required|array',
            'prices.*.price' => 'numeric|min:0|required_with:prices.*.weight',
            'prices.*.weight' => 'numeric|required_with:prices.*.price',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:5120'
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
            'prices.*.price.min' => 'Each price must be at least 0.',
            'prices.*.price.required_with' => 'You must provide a price for each weight.',

            'prices.*.weight.numeric' => 'Each weight must be a number.',
            'prices.*.weight.required_with' => 'You must provide a weight for each price.',

            'category_id.required' => 'A category is required.',
            'category_id.exists' => 'The selected category is invalid.',

            'image.required' => 'An image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.max' => 'The image must not be larger than 5MB.',
        ]);

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

        $food = Food::create([
            'name' => str(trim($validated['name']))->title(),
            'slug' => Str::slug($validated['name']),
            'description' => str($validated['description'])->trim()->lower()->ucfirst(),
            'category_id' => $validated['category_id'],
            'image_url' => $this->image->store('food', 'public')
        ]);
        $sizes = $this->getAllSizes();

        foreach ($sizes as $size) {
            $price = $this->prices[$size->id]['price'] ?? null;
            $weight = $this->prices[$size->id]['weight'] ?? null;

            if (($price !== null && $price !== '') || ($weight !== null && $weight !== '')) {
                FoodPrice::create([
                    'food_id' => $food->id,
                    'size_id' => $size->id,
                    'price' => $price,
                    'weight' => $weight
                ]);
            }
        }
        session()->flash('success', 'New food added');
        $this->reset();
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
        $categories = $this->getAllCategories();
        $sizes = $this->getAllSizes();
        return view('livewire.admin.add-food', [
            'categories' => $categories,
            'sizes' => $sizes
        ]);
    }
}

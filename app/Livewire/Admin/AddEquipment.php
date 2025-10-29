<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use App\Models\EquipmentImage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.admin')]
class AddEquipment extends Component
{
    use WithFileUploads;
    public $name = null;
    public $description = null;
    public $size = null;
    public $price = null;
    public $weight;
    public $caution_fee = null;
    public $images = [];

    public function storeEquipment()
    {
        $validated = $this->validate([
            'name' => 'required|max:150|unique:equipment,name',
            'description' => 'required|string|min:5',
            'size' => 'required|max:150',
            'price' => 'required|numeric',
            'caution_fee' => 'required|numeric',
            'weight' => 'required|numeric',
            'images' => 'required|array|min:1|max:3',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $manager = ImageManager::withDriver(new Driver); // Make sure 'gd' is enabled

        foreach ($this->images as $key => $image) {
            $img = $manager->read($image->getRealPath());

            $width = $img->width();
            $height = $img->height();

            $expectedRatio = 5 / 3;
            $actualRatio = $width / $height;
            $tolerance = 0.02;

            if (abs($actualRatio - $expectedRatio) > $tolerance) {
                $pro = $key + 1;
                $this->addError("images", "Image must have a 5:3 aspect ratio. image-$pro");
                return;
            }
        };

        $equipment = Equipment::create([
            'name' => str($this->name)->trim(),
            'slug' => Str::slug($validated['name']),
            'size' => str($this->size)->trim(),
            'price' => str($this->price)->trim(),
            'caution_fee' => str($this->caution_fee)->trim(),
            'weight' => str($this->weight)->trim(),
            'description' => str($this->description)->trim(),
        ]);

        if ($this->images) {
            foreach ($this->images as $image) {
                $path = $image->store('equipment_images', 'public');
                EquipmentImage::create([
                    'equipment_id' => $equipment->id,
                    'image_url' => $path
                ]);
            }
        }
        session()->flash('success', 'New equipment added');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.add-equipment');
    }
}

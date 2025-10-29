<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use App\Models\EquipmentImage;
use Flux\Flux;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class Equipments extends Component
{
    use WithPagination, WithFileUploads;

    public $search = null;
    public $name = null;
    public $size = null;
    public $price = null;
    public $weight = null;
    public $caution_fee = null;
    public $equipmentId = null;
    public $description = null;
    public $is_featured = null;
    public $existingImages = [];
    public $images = [];
    public $selectedEquipment = null;

    #[On('edit-equipment')]
    public function confirmingEdit($equipment)
    {
        $equipment = Equipment::with('images')
            ->where('slug', $equipment)
            ->firstOrFail();

        $this->name = $equipment->name;
        $this->size = $equipment->size;
        $this->description = $equipment->description;
        $this->price = $equipment->price;
        $this->weight = $equipment->weight;
        $this->caution_fee = $equipment->caution_fee;
        $this->existingImages = $equipment->images;
        $this->is_featured = $equipment->is_featured;
        $this->equipmentId = $equipment->id;
    }

    public function updateEquipment()
    {
        $equipment = Equipment::findOrFail($this->equipmentId);
        $validated = $this->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/', // Allowing only letters, numbers, and spaces
                'max:100',
                Rule::unique('equipment', 'name')->ignore($this->equipmentId),
            ],
            'description' => 'required|string|min:5',
            'size' => 'required|max:150',
            'price' => 'required|numeric',
            'caution_fee' => 'required|numeric',
            'weight' => 'required|numeric',
            'is_featured' => 'boolean',
            'images' => 'array|max:3',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $equipment->update([
            'name' => str($this->name)->trim(),
            'slug' => Str::slug($validated['name']),
            'size' => str($this->size)->trim(),
            'price' => str($this->price)->trim(),
            'caution_fee' => str($this->caution_fee)->trim(),
            'weight' => str($this->weight)->trim(),
            'is_featured' => $this->is_featured,
            'description' => str($this->description)->trim(),
        ]);
        if (!empty($this->images)) {
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


            foreach ($equipment->images as $oldImage) {
                if (Storage::exists($oldImage->image_url)) {
                    Storage::delete($oldImage->image_url);
                }
                $oldImage->delete();
            }
            foreach ($this->images as $image) {
                $path = $image->store('equipment_images', 'public');
                EquipmentImage::create([
                    'equipment_id' => $equipment->id,
                    'image_url' => $path
                ]);
            }
        }

        Flux::modal('edit-equipment')->close();
        return redirect()->route('admin.equipments')->with('success', 'Equipment details updated');
    }

    #[On('delete-gallery')]
    public function confirmingDelete($id)
    {
        $this->equipmentId = $id;
    }

    public function deleteEquipment()
    {
        $equipment = Equipment::findOrFail($this->equipmentId);

        foreach ($equipment->images as $equipmentImage) {
            if ($equipmentImage->image_url && File::exists(public_path($equipmentImage->image_url))) {
                File::delete(public_path($equipmentImage->image_url));
            }
            $equipmentImage->delete();
        }

        // Now delete the equipment item itself
        $equipment->delete();
        Flux::modal('delete-equipment')->close();
        return redirect()->route('admin.equipments')->with('success', 'deleted successfully');
    }

    public function toggleStatus($equipment)
    {
        $equipment = Equipment::findOrFail($equipment);
        $equipment->update([
            'is_featured' => !$equipment->is_featured
        ]);
    }
    public function render()
    {
        $query = Equipment::query();
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        $equipments = $query->with('images')->latest()->paginate(10);
        return view('livewire.admin.equipments', [
            'equipments' => $equipments
        ]);
    }
}

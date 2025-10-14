<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class AddGallery extends Component
{
    use WithFileUploads;
    public $title = null;
    public $description = null;
    public $facebook_link = null;
    public $instagram_link = null;
    public $tiktok_link = null;
    public $images = [];

    public function storeEvent()
    {
        $validated = $this->validate([
            'title' => 'required|max:150|unique:galleries,title',
            'description' => 'required|string|min:5',
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url',
            'tiktok_link' => 'required|url',
            'images' => 'required|array|min:1|max:3',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $manager = ImageManager::withDriver(new Driver); // Make sure 'gd' is enabled

        foreach ($this->images as $key => $image) {
            $img = $manager->read($image->getRealPath());

            $width = $img->width();
            $height = $img->height();

            $expectedRatio = 4 / 3;
            $actualRatio = $width / $height;
            $tolerance = 0.02;

            if (abs($actualRatio - $expectedRatio) > $tolerance) {
                $pro = $key + 1;
                $this->addError("images", "Image must have a 4:3 aspect ratio. image-$pro");
                return;
            }
        };

        $gallery = Gallery::create([
            'title' => str($this->title)->trim(),
            'slug' => Str::slug($validated['title']),
            'description' => str($this->description)->trim(),
            'facebook_link' => $this->facebook_link,
            'instagram_link' => $this->instagram_link,
            'tiktok_link' => $this->tiktok_link
        ]);

        if ($this->images) {
            foreach ($this->images as $image) {
                $path = $image->store('gallery_images', 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_url' => $path
                ]);
            }
        }
        session()->flash('success', 'New event added');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.add-gallery');
    }
}

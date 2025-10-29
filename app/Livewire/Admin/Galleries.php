<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Flux\Flux;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class Galleries extends Component
{
    use WithPagination, WithFileUploads;

    public $search = null;
    public $title = null;
    public $galleryId = null;
    public $description = null;
    public $facebook_link = null;
    public $instagram_link = null;
    public $tiktok_link = null;
    public $is_featured = null;
    public $existingImages = [];
    public $images = [];
    public $selectedGallery = null;

    #[On('edit-gallery')]
    public function confirmingEdit($gallery)
    {
        $gallery = Gallery::with('images')
            ->where('slug', $gallery)
            ->firstOrFail();

        $this->title = $gallery->title;
        $this->description = $gallery->description;
        $this->facebook_link = $gallery->facebook_link;
        $this->instagram_link = $gallery->instagram_link;
        $this->tiktok_link = $gallery->tiktok_link;
        $this->existingImages = $gallery->images;
        $this->is_featured = $gallery->is_featured;
        $this->galleryId = $gallery->id;
    }

    public function updateGallery()
    {
        $gallery = Gallery::findOrFail($this->galleryId);
        $validated = $this->validate([
            'title' => [
                'required',
                'max:150',
                Rule::unique('galleries', 'title')->ignore($this->galleryId),
            ],
            'description' => 'required|string|min:5',
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url',
            'tiktok_link' => 'required|url',
            'is_featured' => 'boolean',
            'images' => 'array|max:3',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gallery->update([
            'title' => str($this->title)->trim(),
            'slug' => Str::slug($validated['title']),
            'is_featured' => $this->is_featured,
            'description' => str($this->description)->trim(),
            'facebook_link' => $this->facebook_link,
            'instagram_link' => $this->instagram_link,
            'tiktok_link' => $this->tiktok_link
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

            foreach ($gallery->images as $oldImage) {
                if (Storage::exists($oldImage->image_url)) {
                    Storage::delete($oldImage->image_url);
                }
                $oldImage->delete();
            }
            foreach ($this->images as $image) {
                $path = $image->store('gallery_images', 'public');
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_url' => $path
                ]);
            }
        }

        Flux::modal('edit-gallery')->close();
        return redirect()->route('admin.galleries')->with('success', 'Event updated');
    }

    #[On('delete-gallery')]
    public function confirmingDelete($id)
    {
        $this->galleryId = $id;
    }

    public function deleteGallery()
    {
        $gallery = Gallery::findOrFail($this->galleryId);

        foreach ($gallery->images as $galleryImage) {
            if ($galleryImage->image_url && File::exists(public_path($galleryImage->image_url))) {
                File::delete(public_path($galleryImage->image_url));
            }
            $galleryImage->delete();
        }

        // Now delete the gallery item itself
        $gallery->delete();
        Flux::modal('delete-gallery')->close();
        return redirect()->route('admin.galleries')->with('success', 'deleted successfully');
    }

    public function toggleStatus($gallery)
    {
        $gallery = Gallery::findOrFail($gallery);
        $gallery->update([
            'is_featured' => !$gallery->is_featured
        ]);
    }
    public function render()
    {
        $query = Gallery::query();
        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }
        $galleries = $query->with('images')->latest()->paginate(10);
        return view('livewire.admin.galleries', [
            'galleries' => $galleries
        ]);
    }
}

<?php

namespace App\Livewire\Customer;

use App\Models\General;
use Livewire\Component;

class SocialLinks extends Component
{
    public function render()
    {
        $data = General::take(1)->first();
        return view('livewire.customer.social-links', [
            'facebook_link' => $data->facebook_link,
            'instagram_link' => $data->instagram_link,
            'tiktok_link' => $data->tiktok_link,
        ]);
    }
}

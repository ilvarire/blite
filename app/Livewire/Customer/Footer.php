<?php

namespace App\Livewire\Customer;

use App\Models\General;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $data = General::take(1)->first();
        return view('livewire.customer.footer', [
            'data' => $data
        ]);
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\County;
use App\Models\ShippingFee;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class AddShippingRates extends Component
{
    public $county_id, $state, $base_fee, $fee_per_kg;
    public $counties;

    public function mount()
    {
        $this->counties = County::all();
    }

    protected function unmask($value)
    {
        return (float) str_replace([',', ' '], '', $value);
    }

    public function storeShippingFee()
    {
        $this->base_fee = $this->unmask($this->base_fee);
        $this->fee_per_kg = $this->unmask($this->fee_per_kg);

        $this->validate([
            'county_id' => 'required|exists:counties,id|max:255',
            'state' => "required|regex:/^[a-zA-Z0-9\s\.,'&]+$/|max:255",
            'base_fee' => 'required|numeric|min:0',
            'fee_per_kg' => 'required|numeric|min:0',
        ]);

        ShippingFee::create([
            'county_id' => $this->county_id,
            'state' => str($this->state)->trim()->title(),
            'base_fee' => str($this->base_fee)->trim(),
            'fee_per_kg' => str($this->fee_per_kg)->trim()
        ]);

        session()->flash('success', 'Shipping info added successfully');
        $this->reset(['county_id', 'state', 'base_fee', 'fee_per_kg']);
    }
    public function render()
    {
        return view('livewire.admin.add-shipping-rates');
    }
}

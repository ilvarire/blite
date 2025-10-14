<?php

namespace App\Livewire\Admin;

use App\Models\County;
use App\Models\ShippingFee;
use Flux\Flux;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class ShippingRates extends Component
{
    use WithPagination;
    public $state = null;
    public $base_fee = null;
    public $fee_per_kg = null;
    public $county = null;
    public $shippingRateId = null;

    public $selectedcounty = null;
    public $search = null;

    #[On('edit-rate')]
    public function editcounty($mode, $shippingRate)
    {
        $shippingRate = ShippingFee::with('county')->findOrFail($shippingRate);
        if ($shippingRate) {
            $this->state = $shippingRate->state;
            $this->base_fee = $shippingRate->base_fee;
            $this->fee_per_kg = $shippingRate->fee_per_kg;
            $this->county = $shippingRate->county->slug;
            $this->shippingRateId = $shippingRate->id;
        } else {
            dd('nothing');
        }
    }
    protected function unmask($value)
    {
        return (float) str_replace([',', ' '], '', $value);
    }

    public function updateRate()
    {
        $rate = ShippingFee::findOrFail($this->shippingRateId);
        if ($rate) {
            $this->base_fee = $this->unmask($this->base_fee);
            $this->fee_per_kg = $this->unmask($this->fee_per_kg);
            $validated = $this->validate([
                'county' => 'required|exists:counties,slug|max:255',
                'state' => "required|regex:/^[a-zA-Z0-9\s\.,'&]+$/|max:255",
                'base_fee' => 'required|numeric|min:0',
                'fee_per_kg' => 'required|numeric|min:0'
            ]);
            $county_id = County::where('slug', $validated['county'])->value('id');
            $shippingRate = ShippingFee::findOrFail($this->shippingRateId);
            $shippingRate->update([
                'county_id' => $county_id,
                'state' => str($validated['state'])->trim()->title(),
                'base_fee' => str($validated['base_fee'])->trim(),
                'fee_per_kg' => str($validated['fee_per_kg'])->trim()
            ]);

            Flux::modal('edit-rate')->close();
            session()->flash('success', 'Shipping rate updated');
            $this->reset();
        }
    }

    #[On('delete-rate')]
    public function confirmingDelete($id)
    {

        $this->shippingRateId = $id;
    }

    public function deleteRate()
    {
        if ($this->shippingRateId) {
            $shippingRate = ShippingFee::findOrFail($this->shippingRateId);
            if ($shippingRate) {
                $shippingRate->delete();
                Flux::modal('delete-rate')->close();
                session()->flash('success', 'Shipping rate deleted');
                $this->reset();
            } else {
                return redirect()->route('admin.rates');
            }
        }
    }

    public function getAllcounties()
    {
        return county::all();
    }
    public function render()
    {
        $query = ShippingFee::query();

        if (!empty($this->search)) {
            $query->where('state', 'like', '%' . $this->search . '%');
        }
        if (!empty($this->selectedCounty)) {
            $query->where('county_id', $this->selectedCounty);
        }

        $shippingRates = $query->with('county')->latest()->paginate(10);
        $counties = $this->getAllcounties();
        return view('livewire.admin.shipping-rates', [
            'counties' => $counties,
            'shippingRates' => $shippingRates,
        ]);
    }
}

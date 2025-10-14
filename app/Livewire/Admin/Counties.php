<?php

namespace App\Livewire\Admin;

use App\Models\County;
use Flux\Flux;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Counties extends Component
{
    #[Validate("required|unique:counties|regex:/^[a-zA-Z0-9\s\,&']+$/|max:100")]
    public $name = null;
    #[Validate('required|unique:counties|max:100')]
    public $code = null;

    public $editName = null;
    public $editCode = null;
    public $countyId = null;

    public function storeCounty()
    {
        $name = $this->validateOnly('name')['name'];
        $code = $this->validateOnly('code')['code'];

        County::create([
            'name' => str(trim($name))->title(),
            'slug' => Str::slug($name),
            'code' => str($code)->trim()->upper()
        ]);

        session()->flash('success', 'new county created');
        $this->reset();
    }

    #[On('edit-county')]
    public function editCounty($mode, $county)
    {
        $county = County::where('slug', $county)->first();
        if ($county) {
            $this->editName = $county->name;
            $this->editCode = $county->code;
            $this->countyId = $county->id;
        } else {
            dd('nothing');
        }
    }

    function updateCounty()
    {
        $this->validate([
            'editName' => "required|regex:/^[a-zA-Z0-9\s\,&']+$/|min:2",
            'editCode' => 'required|alpha|unique:counties|max:8',
            'countyId' => 'required|exists:counties,id'
        ]);

        $county = county::findOrFail($this->countyId);

        $county->update([
            'name' => str($this->editName)->trim()->lower()->title(),
            'code' => str($this->editCode)->trim()->upper(),
            'slug' => Str::slug($this->editName)
        ]);
        Flux::modal('edit-county')->close();
        $this->reset();
        session()->flash('success', 'county updated!');
    }

    #[On('delete-county')]
    public function confirmingDelete($id)
    {
        $this->countyId = $id;
    }

    public function deleteCounty()
    {
        if ($this->countyId) {
            $county = county::findOrFail($this->countyId);
            if ($county) {
                $county->delete();
                Flux::modal('delete-county')->close();
                session()->flash('success', 'county deleted');
                $this->reset();
            }
        }
    }

    public function getAllcounties()
    {
        return County::all();
    }
    public function render()
    {
        $counties = $this->getAllCounties();
        return view('livewire.admin.counties', [
            'counties' => $counties
        ]);
    }
}

<?php

namespace App\Livewire\Customer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class ProfileInfo extends Component
{
    public $name;
    public $email;

    public $old_password;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }
    public function updateName()
    {
        $this->validate([
            'name' => 'required|string|max:50',
        ]);

        User::where('id', Auth::id())->update([
            'name' => str($this->name)->lower(),
        ]);

        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . 'Name' . '</h4>')
            ->text('updated successfully.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($this->old_password, Auth::user()->password)) {
            $this->addError('old_password', 'The old password is incorrect.');
            return;
        }

        User::where('id', Auth::id())->update([
            'password' => Hash::make($this->password),
        ]);

        // Reset the form inputs
        $this->reset(['old_password', 'password', 'password_confirmation']);

        LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . 'Password ' . '</h4>')
            ->text('updated successfully.')
            ->success()
            ->toast()
            ->position('center')
            ->show();
    }
    public function render()
    {
        return view('livewire.customer.profile-info');
    }
}

<?php

namespace App\Livewire\Admin;

use App\Mail\AccountInfoUpdated;
use App\Models\Banking;
use App\Models\General;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Settings extends Component
{
    public $bank_name = null;
    public  $sort_code = null;
    public $account_name = null;
    public $account_number = null;
    public $policy = null;
    public $about = null;
    public $guide = null;

    public $email = null;
    public $location = null;
    public $phone = null;
    public $pickup_location = null;
    public $pickup_time = null;
    public $facebook_link = null;
    public $instagram_link = null;
    public $tiktok_link = null;

    protected $rules = [
        'bank_name' => 'required|string|max:255',
        'account_name' => 'required|string|max:255',
        'account_number' => 'required|numeric',
        'sort_code' => 'required|string|max:15',
    ];

    public function mount()
    {
        $this->loadData();
        $this->loadBanking();
    }
    private function loadData()
    {
        $general = General::take(1)->first();
        $this->policy = $general->policy;
        $this->about = $general->about;
        $this->guide = $general->guide;

        $this->email = $general->email;
        $this->phone = $general->phone;
        $this->location = $general->location;
        $this->pickup_location = $general->pickup_location;
        $this->pickup_time = $general->pickup_time;

        $this->facebook_link = $general->facebook_link;
        $this->instagram_link = $general->instagram_link;
        $this->tiktok_link = $general->tiktok_link;
    }
    private function loadBanking()
    {
        $banking = Banking::take(1)->first();
        $this->bank_name = $banking->bank_name;
        $this->sort_code = $banking->sort_code;
        $this->account_name = $banking->account_name;
        $this->account_number = $banking->account_number;
    }
    public function updateBank()
    {
        $validated = $this->validate();
        // Convert all fields to uppercase
        $validated = array_map(function ($value) {
            return is_string($value) ? strtoupper($value) : $value;
        }, $validated);

        $general = General::take(1)->first();
        try {
            $banking = Banking::first();
            if ($banking) {
                if ($general->checkout) {
                    $this->addError('bank_name', 'Turn off payment process to update checkout account details.');
                    return;
                }
                $banking->update($validated);
                $this->loadBanking();

                //send mail to admin
                $admin = User::where('role', 1)->value('email');
                if ($admin) {
                    Mail::to($admin)->send(
                        new AccountInfoUpdated()
                    );
                }

                session()->flash('success', 'Account details updated successfully');
            } else {
                return redirect()->route('admin.settings');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.settings');
        }
    }

    public function updateSiteInfo()
    {
        $validated = $this->validate([
            'policy' => 'required|string',
            'about' => 'required|string',
            'guide' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'pickup_location' => 'required|string|max:255',
            'pickup_time' => 'required|string|max:25',
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url',
            'tiktok_link' => 'required|url',
        ]);
        $general = General::take(1)->first();
        $general->update($validated);
        $this->loadData();
        session()->flash('success', 'Site Info updated successfully');
    }
    public function toggleCheckout()
    {
        $general = General::take(1)->first();
        $general->update([
            'checkout' => !$general->checkout
        ]);
    }
    public function toggleMaintenance()
    {
        $general = General::take(1)->first();
        $general->update([
            'maintenance' => !$general->maintenance
        ]);
    }
    public function render()
    {
        $general = General::take(1)->first();
        return view('livewire.admin.settings', [
            'general' => $general
        ]);
    }
}

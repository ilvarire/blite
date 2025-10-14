<?php

namespace App\Livewire\Customer;

use App\Mail\ServiceBooking;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Catering extends Component
{
    public $name, $phone_number, $email, $people, $date, $time;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone_number' => 'required|numeric|min:8',
        'email' => 'required|email',
        'people' => 'required|numeric|min:1',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
    ];

    public function bookService()
    {
        $validated = $this->validate();
        $existingBooking = Booking::where('email', $validated['email'])
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($existingBooking) {
            LivewireAlert::title('Booking Exists')
                ->text('Booking already sent.')
                ->toast()
                ->info()
                ->position('center')
                ->show();
            return; // Stop further execution
        }
        try {
            $booking = Booking::create($validated);
            $admin = User::where('role', 1)->value('email');
            if ($booking) {
                Mail::to($admin)->send(
                    new ServiceBooking($booking)
                );
            }
            LivewireAlert::title('<h4 style="color: red; font-family: Lobster, cursive !important;">' . 'Message' . '</h4>')
                ->text('sent successfully.')
                ->success()
                ->toast()
                ->position('center')
                ->show();
            $this->reset();
        } catch (\Exception $e) {
            LivewireAlert::title('Error')
                ->text($e->getMessage())
                ->toast()
                ->error()
                ->position('center')
                ->show();
        }

        session()->flash('message', 'Booking successful!');
    }

    public function render()
    {
        return view('livewire.customer.catering');
    }
}

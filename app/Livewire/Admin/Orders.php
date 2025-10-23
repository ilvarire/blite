<?php

namespace App\Livewire\Admin;

use App\Mail\NewOrderNotification;
use App\Mail\OrderCancelled;
use App\Mail\OrderDelivered;
use App\Mail\OrderPlaced;
use App\Models\Order;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.admin')]

class Orders extends Component
{
    public $search = '';
    public $status;
    public $selectedOrder;
    public $orderId;

    #[On('edit-order')]
    public function confirmingEdit($order)
    {
        $this->getOrder($order);
    }
    private function getOrder($order)
    {
        $order = Order::with('items.product', 'shippingAddress')
            ->where('reference', $order)->firstOrFail();

        $this->selectedOrder = $order;
    }

    public function confirmOrderPayment($id)
    {
        $order = Order::findOrFail($id);
        if ($order->payment_status != 'paid') {
            $order->status = 'processing';
            $order->payment_status = 'paid';
            $order->save();

            Mail::to(Auth::user()->email)->send(
                new NewOrderNotification($order)
            );

            Mail::to($order->user->email)->send(
                new OrderPlaced($order)
            );

            Flux::modal('edit-order')->close();
            $this->reset();
            session()->flash('success', 'Order Marked as Paid!');
            return;
        }
        session()->flash('error', 'Order already marked as paid');
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'completed') {
            session()->flash('error', 'Cannot cancel completed orders');
            return;
        }
        if ($order->payment_status != 'paid') {
            session()->flash('error', 'Cannot cancel unpaid orders');
            return;
        }
        $order->status = 'cancelled';
        $order->save();
        Flux::modal('edit-order')->close();
        $this->reset();
        Mail::to($order->user->email)->send(
            new OrderCancelled($order)
        );
        session()->flash('success', 'Order cancelled!');
    }

    public function refundOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'completed') {
            session()->flash('error', 'Cannot refund completed orders');
            return;
        }
        if ($order->payment_status != 'paid') {
            session()->flash('error', 'Cannot refund unpaid orders');
            return;
        }
        $order->payment_status = 'refunded';
        $order->save();
        Flux::modal('edit-order')->close();
        $this->reset();
        session()->flash('success', 'Order Payment Refunded!');
    }

    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status !== 'processing') {
            session()->flash('error', 'Only processing orders can be Completed');
            return;
        }

        $order->status = 'completed';
        $order->save();
        Flux::modal('edit-order')->close();
        $this->reset();

        Mail::to($order->user->email)->send(
            new OrderDelivered($order->reference)
        );
        session()->flash('success', 'Order marked as Completed');
    }

    #[On('delete-order')]
    public function confirmingDelete($id)
    {
        $this->orderId = $id;
    }

    public function deleteOrder()
    {
        if ($this->orderId) {
            $order = Order::findOrFail($this->orderId);
            if ($order) {
                $order->delete();
                Flux::modal('delete-order')->close();
                session()->flash('success', 'Order deleted');
                $this->reset();
            }
        }
    }

    public function render()
    {
        $orders = Order::with('user')
            ->when($this->search, fn($query) =>
            $query->whereHas(
                'user',
                fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
            ))
            ->when(
                $this->status,
                fn($query) =>
                $query->where('status', $this->status)
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.orders', [
            'orders' => $orders
        ]);
    }
}

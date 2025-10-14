<?php

namespace App\Http\Controllers;

use App\Helpers\CartManagement;
use App\Models\General;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class AuthCustomerController extends Controller
{
    public function checkout()
    {
        if (auth()->check()) {
            $cartItems = CartManagement::getCartItemsFromCookie();
            return view('pages.checkout-page', ['cartItems' => $cartItems]);
        } else {
            return redirect()->route('login');
        }
    }

    public function pay($reference)
    {
        $order = Order::where('reference', $reference)->first();

        // If order doesn't exist, abort 404
        if (!$order) {
            abort(404, 'Order not found');
        }

        // If the authenticated user does not own the order, abort 403
        if ($order->user_id !== Auth::id()) {
            abort(404, 'Order not found');
        }

        if ($order->payment_status !== 'pending') {
            // move to order page
            abort(404, 'Order not found');
        }
        return view('pages.pay', [
            'reference' => $reference,
            'amount' => $order->total_price
        ]);
    }

    public function orders()
    {
        if (auth()->check()) {
            return view('pages.orders-page');
        } else {
            return redirect()->route('login');
        }
    }


    public function orderDetails($reference)
    {
        $order = Order::with('items.product', 'shippingAddress')
            ->where('reference', $reference)
            ->where('user_id', Auth::user()->id)->firstOrFail();
        if (!$order) {
            abort(404, 'Order not found');
        }
        return view('pages.order-details', ['reference' => $order->reference]);
    }

    public function profile()
    {
        return view('pages.profile-page');
    }
}

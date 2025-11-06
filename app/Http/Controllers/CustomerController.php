<?php

namespace App\Http\Controllers;

use App\Helpers\CartSession;
use App\Models\Equipment;
use App\Models\Food;
use App\Models\Gallery;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function home()
    {
        return view('pages.index');
    }

    public function cart()
    {
        $cartItems = CartSession::getCartItemsFromSession();
        $moreFoods = Food::with('prices', 'category')
            ->where('is_featured', true)->take(4)
            ->get();
        return view('pages.cart-page', [
            'cartItems' => $cartItems,
            'moreFoods' => $moreFoods
        ]);
    }

    public function food()
    {
        return view('pages.food-page');
    }

    public function foodDetails($slug)
    {

        $food = Food::with('category', 'prices')->where('slug', $slug)->first();

        if (!$food) {
            abort(404, 'Food not found');
        }
        return view('pages.food-details', ['food' => $food]);
    }

    public function equipments()
    {
        return view('pages.equipments-page');
    }
    public function equipmentDetails($slug)
    {
        $equipment = Equipment::with('images')->where('slug', $slug)->first();

        if (!$equipment) {
            abort(404, 'Food not found');
        }
        return view('pages.equipment-details', ['equipment' => $equipment]);
    }

    public function galleries()
    {
        return view('pages.galleries-page');
    }
    public function galleryDetails($slug)
    {
        $gallery = Gallery::with('images')->where('slug', $slug)->first();

        if (!$gallery) {
            abort(404, 'Event not found');
        }
        return view('pages.gallery-details', ['gallery' => $gallery]);
    }
    public function policy()
    {
        return view('pages.policy-page');
    }
    public function about()
    {
        return view('pages.about-page');
    }
    public function guide()
    {
        return view('pages.guide-page');
    }
}

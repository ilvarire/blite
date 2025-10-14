<?php

namespace App\Helpers;

use App\Models\Equipment;
use App\Models\Food;
use App\Models\FoodPrice;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (! $cart_items) {
            $cart_items = [];
        }

        $validatedCart = [];

        foreach ($cart_items as $item) {
            if (! isset($item['product_type'])) {
                continue; // skip invalid
            }

            // -------------------
            // CASE 1: Food Items
            // -------------------
            if ($item['product_type'] === 'food') {
                $food = Food::find($item['food_id']);
                $sizePrice = FoodPrice::where('food_id', $item['food_id'])
                    ->where('size_id', $item['size_id'])->first();

                if ($food && $sizePrice) {
                    $quantity = max(1, (int) $item['quantity']);
                    $validatedCart[] = [
                        'product_type' => 'food',
                        'food_id'      => $food->id,
                        'name'         => $food->name,
                        'slug'         => $food->slug,
                        'image_url'    => $food->image_url,
                        'size_id'      => $item['size_id'],
                        'size'         => $item['size'],
                        'weight' => $sizePrice->weight,
                        'quantity'     => $quantity,
                        'unit_price'   => $sizePrice->price,
                        'total_amount' => $sizePrice->price * $quantity,
                    ];
                }
            }

            // ------------------------
            // CASE 2: Equipment Items
            // ------------------------
            if ($item['product_type'] === 'equipment') {
                $equipment = Equipment::find($item['equipment_id']);
                if ($equipment) {
                    if ($item['rental_duration'] % 24 !== 0 || $item['rental_duration'] > 4 * 24) {
                        $duration = 24;
                    } else {
                        $duration = (int) $item['rental_duration'];
                    }
                    $quantity = isset($item['quantity']) ? max(1, (int) $item['quantity']) : 1;
                    $days = $duration / 24;

                    $validatedRentalStart = empty($item['rental_start']) || !Carbon::canBeCreatedFromFormat($item['rental_start'], 'Y-m-d')
                        ? Carbon::tomorrow()->toDateString()
                        : Carbon::parse($item['rental_start']);

                    if (is_string($validatedRentalStart)) {
                        $validatedRentalStart = Carbon::parse($validatedRentalStart);
                    }
                    // Ensure the rental_start date is at least tomorrow
                    if ($validatedRentalStart->isBefore(Carbon::tomorrow())) {
                        $validatedRentalStart = Carbon::tomorrow()->toDateString();
                    }

                    // Ensure the rental_start date is no more than 150 days in the future
                    if ($validatedRentalStart->isAfter(Carbon::now()->addDays(150))) {
                        $validatedRentalStart = Carbon::tomorrow()->toDateString();
                    }

                    $validatedCart[] = [
                        'product_type'   => 'equipment',
                        'equipment_id'   => $equipment->id,
                        'name'           => $equipment->name,
                        'slug'           => $equipment->slug,
                        'image_url'      => $equipment->images->first()->image_url,
                        'weight' => $equipment->weight,
                        'rental_start'   => Carbon::parse($validatedRentalStart)->toDateString(),
                        'rental_duration' => $duration,
                        'rental_end'     => isset($validatedRentalStart)
                            ? Carbon::parse($validatedRentalStart)->addHours($duration)->toDateString()
                            : null,
                        'unit_price'     => $equipment->price,
                        'caution_fee'    => $equipment->caution_fee,
                        'quantity'       => $quantity,
                        'total_amount'   => $equipment->price * $days * $quantity,
                    ];
                }
            }
        }

        return $validatedCart;
    }

    static public function addFoodItemToCart($food_id, $size_id, $quantity = 1)
    {
        $food = Food::with('prices')
            ->where('id', $food_id)->firstOrFail(['id', 'name', 'image_url']);
        $size = Size::findOrFail($size_id);
        $price = $food->prices->where('size_id', $size_id)->first();
        if (! $price) {
            return redirect()->route('home');
        }

        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'food' && $item['food_id'] == $food_id && $item['size_id'] == $size_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $quantity;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $price->price;
        } else {
            $cart_items[] = [
                'food_id' => $food_id,
                'size_id' => $size_id,
                'name' => $food->name,
                'product_type' => 'food',
                'image_url' => $food->image_url,
                'size' => $size->label,
                'weight' => $price->weight,
                'quantity' => $quantity,
                'unit_price' => $price->price,
                'total_amount' => $quantity * $price->price
            ];
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    static public function addEquipmentToCart($equipment_id, $rental_start, $duration, $quantity = 1)
    {
        $equipment = Equipment::findOrFail($equipment_id);
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;
        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'equipment' && $item['equipment_id'] == $equipment_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['rental_start'] = $rental_start;
            $cart_items[$existing_item]['rental_duration'] = $duration;
            $cart_items[$existing_item]['rental_end'] = Carbon::parse($rental_start)->addHours($duration)->toDateString();
            $cart_items[$existing_item]['quantity'] = $quantity;
            $cart_items[$existing_item]['total_amount'] = $equipment->price * ($duration / 24) * $quantity;
        } else {
            $cart_items[] = [
                'product_type'   => 'equipment',
                'equipment_id'   => $equipment->id,
                'name'           => $equipment->name,
                'slug'         => $equipment->slug,
                'image_url'      => $equipment->images->first()->image_url,
                'weight' => $equipment->weight,
                'rental_start'   => $rental_start,
                'rental_duration' => $duration, // in hours
                'rental_end'     => Carbon::parse($rental_start)->addHours($duration)->toDateString(),
                'unit_price'     => $equipment->price,
                'caution_fee'    => $equipment->caution_fee,
                'quantity'       => $quantity,
                'total_amount'   => $equipment->price * ($duration / 24) * $quantity
            ];
        }
        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    static public function removeFoodFromCart($food_id)
    {
        Food::findOrFail($food_id);
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'food' && $item['food_id'] === $food_id) {
                unset($cart_items[$key]);
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function removeEquipmentFromCart($equipment_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'equipment' && $item['equipment_id'] === $equipment_id) {
                unset($cart_items[$key]);
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function incrementFoodQuantity($food_id)
    {
        Food::findOrFail($food_id);
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'food' && $item['food_id'] === $food_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_price'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function decrementFoodQuantity($food_id)
    {
        Food::findOrFail($food_id);
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'food' && $item['food_id'] == $food_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_price'];
                }
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function incrementEquipmentQuantity($equipment_id)
    {
        Equipment::findOrFail($equipment_id);
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'equipment' && $item['equipment_id'] === $equipment_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * ($cart_items[$key]['rental_duration'] / 24) * $cart_items[$key]['unit_price'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function decrementEquipmentQuantity($equipment_id)
    {
        Equipment::findOrFail($equipment_id);
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_type'] === 'equipment' && $item['equipment_id'] == $equipment_id) {
                if ($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * ($cart_items[$key]['rental_duration'] / 24) * $cart_items[$key]['unit_price'];
                }
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function updateCartSize($index, $newSizeId, $priceData)
    {
        $cart_items = self::getCartItemsFromCookie();
        $cart_items[$index]['size_id'] = $newSizeId;
        $cart_items[$index]['size'] = $priceData->size->label;
        $cart_items[$index]['unit_price'] = $priceData->price;
        $cart_items[$index]['total_amount'] = $priceData->price * $cart_items[$index]['quantity'];

        self::addCartItemsToCookie($cart_items);
    }

    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}

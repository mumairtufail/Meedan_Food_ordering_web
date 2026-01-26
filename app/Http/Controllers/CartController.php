<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
             return redirect()->back()->with('open_login', true);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'addons' => 'array',
            'addons.*' => 'exists:addons,id'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        $userId = Auth::guard('customer')->id();
        $cartKey = 'cart_' . $userId;
        $cart = session()->get($cartKey, []);
        
        $addons = $request->input('addons', []);
        sort($addons);
        $itemKey = 'p_' . $product->id . '_' . implode('_', $addons);
        
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $request->quantity;
        } else {
            $cart[$itemKey] = [
                'type' => 'product',
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'addons' => $addons,
                'image' => $product->images->sortBy('sort_order')->first()?->image_path
            ];
        }
        
        session()->put($cartKey, $cart);
        
        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function addDeal(Request $request, Deal $deal)
    {
        if (!Auth::check()) {
             return redirect()->back()->with('open_login', true);
        }

        $userId = Auth::id();
        $cartKey = 'cart_' . $userId;
        $cart = session()->get($cartKey, []);
        
        $itemKey = 'd_' . $deal->id;
        
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity']++;
        } else {
            $cart[$itemKey] = [
                'type' => 'deal',
                'id' => $deal->id,
                'name' => $deal->name,
                'price' => $deal->price,
                'quantity' => 1,
                'products' => $deal->products->pluck('name')->toArray(),
                'image' => $deal->image
            ];
        }

        session()->put($cartKey, $cart);

        return redirect()->back()->with('success', 'Deal added to cart!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $featuredDeals = Deal::where('is_active', true)->latest()->take(3)->get();
        $categories = Category::where('is_active', true)->take(4)->get(); // Get first 4 for highlights
        $products = Product::where('is_active', true)
            ->with(['images', 'addons', 'category'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pages.home', compact('featuredDeals', 'categories', 'products'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)->get();
        return view('pages.categories', compact('categories'));
    }

    public function menu(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'images', 'addons']);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $categories = Category::where('is_active', true)->get();
        $products = $query->paginate(12)->withQueryString();

        return view('pages.menu', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }
        
        $product->load(['category', 'images', 'addons']);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('pages.product', compact('product', 'relatedProducts'));
    }

    public function deals()
    {
        $deals = Deal::where('is_active', true)->with('products')->paginate(9);
        return view('pages.deals', compact('deals'));
    }

    public function deal(Deal $deal)
    {
        if (!$deal->is_active) {
            abort(404);
        }
        $deal->load('products.images');
        return view('pages.deal', compact('deal'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string'
        ]);

        \App\Models\Contact::create($validated);

        return redirect()->back()->with('success', 'Your message has been received! Our team will get back to you soon.');
    }

    public function reservation()
    {
        return view('pages.reservation');
    }

    public function storeReservation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'notes' => 'nullable|string'
        ]);

        \App\Models\Reservation::create($validated);

        return redirect()->back()->with('success', 'Table reservation confirmed! We look forward to seeing you.');
    }
}

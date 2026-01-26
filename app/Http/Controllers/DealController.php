<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::latest()->paginate(10);
        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('deals.form', ['deal' => new Deal(), 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'products' => 'array',
            'products.*' => 'exists:products,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('deals', 'public');
            $validated['image'] = $path;
        }
        
        $deal = Deal::create($validated);

        if ($request->has('products')) {
            $deal->products()->sync($request->products);
        }

        return redirect()->route('deals.index')->with('success', 'Deal created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $products = Product::where('is_active', true)->get();
        return view('deals.form', compact('deal', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'products' => 'array',
            'products.*' => 'exists:products,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('deals', 'public');
            $validated['image'] = $path;
        }

        $deal->update($validated);

        if ($request->has('products')) {
            $deal->products()->sync($request->products);
        } else {
             $deal->products()->sync([]);
        }

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();
        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully.');
    }

    public function toggleStatus(Deal $deal)
    {
        $deal->update(['is_active' => !$deal->is_active]);
        return back()->with('success', 'Deal status updated.');
    }
}

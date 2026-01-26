<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Addon;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->pluck('name', 'id');
        $addons = Addon::where('is_active', true)->get();
        return view('products.form', ['product' => new Product(), 'categories' => $categories, 'addons' => $addons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'addons' => 'array',
            'addons.*' => 'exists:addons,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        // Remove helper fields not in product model
        $productData = collect($validated)->except(['images', 'addons'])->toArray();

        $product = Product::create($productData);

        // Handle Addons
        if ($request->has('addons')) {
            $product->addons()->sync($request->addons);
        }

        // Handle Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0, // First image is primary
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->pluck('name', 'id');
        $addons = Addon::where('is_active', true)->get();
        return view('products.form', compact('product', 'categories', 'addons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'addons' => 'array',
            'addons.*' => 'exists:addons,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Remove helper fields
        $productData = collect($validated)->except(['images', 'addons'])->toArray();

        $product->update($productData);

        // Handle Addons
        if ($request->has('addons')) {
            $product->addons()->sync($request->addons);
        } else {
             // If no addons sent (unchecked all), detach all? 
             // Be careful: standard HTML forms don't send anything if no checkboxes checked.
             // Usually we handle this specific case or add a hidden input.
             // For now, assuming if key is present it syncs.
             $product->addons()->sync([]);
        }
        
        // Handle Deletions first
        if ($request->has('delete_images')) {
            $imagesToDelete = ProductImage::whereIn('id', $request->delete_images)
                                        ->where('product_id', $product->id)
                                        ->get();
            
            foreach ($imagesToDelete as $img) {
                // Ideally delete file from storage too
                // Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // Handle Sort Order Updates
        if ($request->has('existing_images')) {
            foreach ($request->existing_images as $imageId => $data) {
                if (isset($data['sort_order'])) {
                    ProductImage::where('id', $imageId)
                              ->where('product_id', $product->id)
                              ->update(['sort_order' => $data['sort_order']]);
                }
            }
        }
        
        // Handle New Images
        if ($request->hasFile('images')) {
             $currentMaxParam = $request->has('existing_images') 
                ? max(array_column($request->existing_images, 'sort_order') ?: [0]) 
                : ($product->images()->max('sort_order') ?? 0);
             
             $startOrder = $currentMaxParam + 1;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => false,
                    'sort_order' => $startOrder + $index,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Product status updated.');
    }
}


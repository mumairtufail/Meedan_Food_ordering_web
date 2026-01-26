<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addons = Addon::paginate(10);
        return view('addons.index', compact('addons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['is_active'] = $validated['is_active'] ?? true;

        Addon::create($validated);

        return redirect()->route('addons.index')->with('success', 'Addon created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Addon $addon)
    {
        return view('addons.edit', compact('addon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Addon $addon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['is_active'] = $request->has('is_active');

        $addon->update($validated);

        return redirect()->route('addons.index')->with('success', 'Addon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addon $addon)
    {
        $addon->delete();
        return redirect()->route('addons.index')->with('success', 'Addon deleted successfully.');
    }

    public function toggleStatus(Addon $addon)
    {
        $addon->update(['is_active' => !$addon->is_active]);
        return back()->with('success', 'Addon status updated.');
    }
}

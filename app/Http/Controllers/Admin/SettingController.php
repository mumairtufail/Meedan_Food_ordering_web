<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_logo' => Setting::get('site_logo', 'https://deliverect.imgix.net/static/9ecd49df-d109-4bbf-b472-0cb96ad459e0/assets/image-1748157162.png?w=1100&fit=crop&crop=top&auto=compress,format&cs=srgb'),
            
            'hero_slide_1_image' => Setting::get('hero_slide_1_image', 'https://images.pexels.com/photos/2641886/pexels-photo-2641886.jpeg?auto=compress&cs=tinysrgb&w=1920'),
            'hero_slide_1_badge' => Setting::get('hero_slide_1_badge', '🔥 Calgary\'s Favorite Middle Eastern Kitchen'),
            'hero_slide_1_title' => Setting::get('hero_slide_1_title', 'Taste the <br class="hidden sm:block"> Middle East.'),
            'hero_slide_1_subtitle' => Setting::get('hero_slide_1_subtitle', 'Authentic dishes crafted with love and the finest ingredients. Bold flavors. Zero compromise.'),
            
            'hero_slide_2_image' => Setting::get('hero_slide_2_image', 'https://images.pexels.com/photos/5836352/pexels-photo-5836352.jpeg?auto=compress&cs=tinysrgb&w=1920'),
            'hero_slide_2_badge' => Setting::get('hero_slide_2_badge', '⭐ Fan Favorite'),
            'hero_slide_2_title' => Setting::get('hero_slide_2_title', 'Smokey Beef <br class="hidden sm:block"> Brisket Bowl.'),
            'hero_slide_2_subtitle' => Setting::get('hero_slide_2_subtitle', '12-hour slow-cooked, packed with bold spices. A masterpiece in every bite.'),
            
            'hero_slide_3_image' => Setting::get('hero_slide_3_image', 'https://images.pexels.com/photos/1893556/pexels-photo-1893556.jpeg?auto=compress&cs=tinysrgb&w=1920'),
            'hero_slide_3_badge' => Setting::get('hero_slide_3_badge', '🍟 The Ultimate Fusion'),
            'hero_slide_3_title' => Setting::get('hero_slide_3_title', 'Meet the <br class="hidden sm:block"> Gyro Poutine.'),
            'hero_slide_3_subtitle' => Setting::get('hero_slide_3_subtitle', 'Quebec meets the Middle East. Savory gyro meat, crispy fries, rich gravy.'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'hero_slide_1_badge', 'hero_slide_1_title', 'hero_slide_1_subtitle',
            'hero_slide_2_badge', 'hero_slide_2_title', 'hero_slide_2_subtitle',
            'hero_slide_3_badge', 'hero_slide_3_title', 'hero_slide_3_subtitle'
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->$key);
            }
        }

        // Handle File Uploads or Direct URLs
        $imageKeys = ['site_logo', 'hero_slide_1_image', 'hero_slide_2_image', 'hero_slide_3_image'];
        foreach ($imageKeys as $key) {
            // 1. Check if a file was uploaded
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('settings', 'public');
                Setting::set($key, asset('storage/' . $path));
            } 
            // 2. Otherwise check if a direct URL was provided in a text field (e.g., site_logo_url)
            elseif ($request->has($key . '_url') && !empty($request->input($key . '_url'))) {
                Setting::set($key, $request->input($key . '_url'));
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['components.layouts.app', 'layouts.app', 'layouts.guest', 'components.ui.layout.public-header', 'components.sections.hero', 'components.application-logo'], function ($view) {
            $view->with('settings', [
                'site_logo' => \App\Models\Setting::get('site_logo', 'https://deliverect.imgix.net/static/9ecd49df-d109-4bbf-b472-0cb96ad459e0/assets/image-1748157162.png?w=1100&fit=crop&crop=top&auto=compress,format&cs=srgb'),
                
                'hero_slide_1_image' => \App\Models\Setting::get('hero_slide_1_image', 'https://images.pexels.com/photos/2641886/pexels-photo-2641886.jpeg?auto=compress&cs=tinysrgb&w=1920'),
                'hero_slide_1_badge' => \App\Models\Setting::get('hero_slide_1_badge', '🔥 Calgary\'s Favorite Middle Eastern Kitchen'),
                'hero_slide_1_title' => \App\Models\Setting::get('hero_slide_1_title', 'Taste the <br class="hidden sm:block"> Middle East.'),
                'hero_slide_1_subtitle' => \App\Models\Setting::get('hero_slide_1_subtitle', 'Authentic dishes crafted with love and the finest ingredients. Bold flavors. Zero compromise.'),
                
                'hero_slide_2_image' => \App\Models\Setting::get('hero_slide_2_image', 'https://images.pexels.com/photos/5836352/pexels-photo-5836352.jpeg?auto=compress&cs=tinysrgb&w=1920'),
                'hero_slide_2_badge' => \App\Models\Setting::get('hero_slide_2_badge', '⭐ Fan Favorite'),
                'hero_slide_2_title' => \App\Models\Setting::get('hero_slide_2_title', 'Smokey Beef <br class="hidden sm:block"> Brisket Bowl.'),
                'hero_slide_2_subtitle' => \App\Models\Setting::get('hero_slide_2_subtitle', '12-hour slow-cooked, packed with bold spices. A masterpiece in every bite.'),
                
                'hero_slide_3_image' => \App\Models\Setting::get('hero_slide_3_image', 'https://images.pexels.com/photos/1893556/pexels-photo-1893556.jpeg?auto=compress&cs=tinysrgb&w=1920'),
                'hero_slide_3_badge' => \App\Models\Setting::get('hero_slide_3_badge', '🍟 The Ultimate Fusion'),
                'hero_slide_3_title' => \App\Models\Setting::get('hero_slide_3_title', 'Meet the <br class="hidden sm:block"> Gyro Poutine.'),
                'hero_slide_3_subtitle' => \App\Models\Setting::get('hero_slide_3_subtitle', 'Quebec meets the Middle East. Savory gyro meat, crispy fries, rich gravy.'),
            ]);
        });
    }
}

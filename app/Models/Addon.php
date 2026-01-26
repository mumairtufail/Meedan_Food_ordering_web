<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'is_active'];

    public function images()
    {
        return $this->hasMany(AddonImage::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_addon');
    }
}

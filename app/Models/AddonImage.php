<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonImage extends Model
{
    use HasFactory;

    protected $fillable = ['addon_id', 'image_path'];

    public function addon()
    {
        return $this->belongsTo(Addon::class);
    }
}

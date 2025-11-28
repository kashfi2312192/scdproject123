<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'slug',
        'short',
        'old_price',
        'discount',
        'stock',
        'sku',
        'category',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->latest();
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('img/logo.webp');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'img/')) {
            return asset($this->image);
        }

        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }

        if (Str::startsWith($this->image, 'products/')) {
            return Storage::url($this->image);
        }

        if (Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        return asset($this->image);
    }
}

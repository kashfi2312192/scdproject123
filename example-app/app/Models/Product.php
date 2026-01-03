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
        'category_id',
        'tags',
        'is_in_stock',
        'discount_percentage',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    public function getCategoryNameAttribute(): ?string
    {
        // If relationship is loaded and is an object, use it
        if ($this->relationLoaded('category') && $this->getRelation('category')) {
            return $this->getRelation('category')->name;
        }
        
        // If category_id exists, load the relationship
        if ($this->category_id) {
            $category = $this->category;
            if (is_object($category)) {
                return $category->name;
            }
        }
        
        // Fallback to string attribute if it exists
        $categoryAttr = $this->getAttribute('category');
        if (is_string($categoryAttr) && !empty($categoryAttr)) {
            return $categoryAttr;
        }
        
        return null;
    }
}

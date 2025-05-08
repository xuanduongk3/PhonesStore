<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    //
    protected $fillable = [
        'product_id',
        'color_id',
        'storage_id',
        'price',
        'discount',
        'stock',
        'image',
    ];

    // Mối quan hệ: Variant thuộc về Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Mối quan hệ: Variant có một Color
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    // Mối quan hệ: Variant có một Storage
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    // Tính giá sau giảm
    public function getDiscountedPriceAttribute()
    {
        return $this->price * (1 - $this->discount / 100);
    }

    // Mối quan hệ với Cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

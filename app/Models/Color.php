<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $fillable = ['name', 'title' , 'hex_code'];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}

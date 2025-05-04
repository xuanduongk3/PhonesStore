<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    //
    protected $fillable = ['capacity'];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}

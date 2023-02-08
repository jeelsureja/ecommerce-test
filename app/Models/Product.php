<?php

namespace App\Models;

use App\Models\ProductBrand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function productsBrand()
    {
        return $this->belongsTo(ProductBrand::class,'brand_id','id');
    }
}

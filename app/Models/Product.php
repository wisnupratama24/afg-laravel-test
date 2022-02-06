<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategories;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function category() {
        return $this->belongsTo('App\Models\ProductCategories', 'product_category_id', 'id');
    }

    public function productDetails() {
        return $this->hasMany('App\Models\ProductDetails', 'product_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
    	'id', 
    	'name', 
        'product_category_id', 
        'images', 
        'price', 
        'stock'
    ];

    protected $hidden = ["deleted_at"];

    public function product_category() 
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }
}

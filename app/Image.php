<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['name', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

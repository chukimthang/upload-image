<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price', 'description'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}

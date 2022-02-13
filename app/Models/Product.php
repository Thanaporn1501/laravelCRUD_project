<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
  
    protected $fillable = ['code','imgcode', 'name', 'price', 'description'];
    
    function category() {
        return $this->belongsTo(Category::class);
    }

    function locations() {
        return $this->belongsToMany(Location::class);
    }
}

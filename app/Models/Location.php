<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name','timeopen','timeclose', 'tel', 'email', 'address', 'latitude', 'longitude'];

    function products() {
        return $this->belongsToMany(Product::class);
    }
}

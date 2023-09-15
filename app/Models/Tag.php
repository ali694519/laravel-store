<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug'
    ];

    public $timestamps = false;


    public function tags() {
        return $this->belongsToMany(
            Product::class);
    }
}

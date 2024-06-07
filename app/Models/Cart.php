<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'finalPrice'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(Section::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name matches the plural form of the model name)
    protected $table = 'products';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'category',
        'product_name',
        'product_price',
        'product_quantity',
    ];

    
}

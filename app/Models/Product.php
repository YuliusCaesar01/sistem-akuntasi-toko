<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_code'; // Assuming product_code is the primary key
    public $incrementing = false; // If product_code is not an integer
    protected $keyType = 'string'; // If product_code is a string

    protected $fillable = ['product_code', 'product_name', 'product_price', 'product_quantity'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_code', 'product_code');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'invoice',
        'product_code',
        'category',
        'product_name',
        'product_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
}

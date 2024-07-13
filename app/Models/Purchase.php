<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'product_code',
        'quantity',
        'total_price',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice', 'invoice_number');
    }
}

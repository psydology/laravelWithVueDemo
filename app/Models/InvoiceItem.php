<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'invoice_id',
        'unit_price',
        'quantity',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
}

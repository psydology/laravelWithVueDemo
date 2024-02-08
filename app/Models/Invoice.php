<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'number',
        'customer_id',
        'date',
        'due_date',
        'referance',
        'terms_conditions',
        'sub_total',
        'discount',
        'total',
        'id'
    ];
    public function customers()
    {
        return $this->belongsTo(Customer::class , 'customer_id' , 'id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}

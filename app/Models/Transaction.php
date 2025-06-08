<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'address_id', 
        'delivery_day', 
        'delivery_time',
        'shipping_method', 
        'payment_method', 
        'shipping_cost',
        'total_price', 
        'virtual_account',
        'bank_option',   
        'status', 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function address() {
        return $this->belongsTo(Address::class);
    }
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionPaypal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'payer_id', 'payment_id', 'price', 'product', 'complete'
    ];
}

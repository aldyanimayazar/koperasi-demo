<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'id', 
        'type',
        'membership_id',
        'amount',
        'interest',
        'interest_by',
        'tenor',
        'admin_fee',
        'note',
        'transaction_number',
        'status',
        'total',
        'installment_payment',
        'type_saving'
    ];

    public function membership()
    {
        return $this->belongsTo('App\Models\MemberShip');
    }
}

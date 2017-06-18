<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    protected $table = 'installment_payments';

    protected $fillable = [
        'transaction_id', 
        'tenor'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function instalmentDetail()
    {
        return $this->hasMany(InstallmentPaymentDetail::class);
    }
}

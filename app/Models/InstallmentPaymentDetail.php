<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPaymentDetail extends Model
{
    protected $table = 'installment_payment_details';

    protected $fillable = [
        'installment_payment_id',
        'transaction_number', 
        'note'
    ];

    protected $hidden = [
        'created_at', 
        'updated_at'
    ];

    public function instalment()
    {
        return $this->belongsTo(InstallmentPayment::class);
    }

    public function instalmentDetail()
    {
        return $this->hasMany(InstallmentPaymentDetail::class);
    }
}

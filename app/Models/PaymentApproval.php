<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PaymentApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'payment_type',
        'status'
    ];

    /**
     * @return MorphTo
     */
    public function payment(): MorphTo
   {
       return $this->morphTo();
   }
}

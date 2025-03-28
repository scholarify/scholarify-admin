<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
        'transId',
        'status',
        'medium',
        'serviceName',
        'transType',
        'amount',
        'revenue',
        'payerName',
        'email',
        'redirectUrl',
        'externalId',
        'userId',
        'webhook',
        'financialTransId',
        'dateInitiated',
        'dateConfirmed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', '_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'summ_from',
        'summ_to',
        'status',
        'currency_from',
        'currency_to',
        'wallet_from',
        'wallet_to',
        'course',
        'user_id',
        'fio',
        'email',
        'country',
    ];

    public function currencyFrom()
    {
        return $this->belongsTo(Currencie::class, 'currency_from');
    }

    public function currencyTo()
    {
        return $this->belongsTo(Currencie::class, 'currency_to');
    }

    public function statusInfo()
    {
        return $this->belongsTo(Status::class, 'status', 'code');
    }

}

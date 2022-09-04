<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'image',
        'reserve',
        'type',
        'network',
        'example',
        'memo_act',
        'memo'
    ];

    public function listExchangesFrom()
    {
        return $this->hasOne(Exchange::class, 'currency_from');
    }

    public function listExchangesTo()
    {
        return $this->hasOne(Exchange::class, 'currency_to');
    }

    public function listsExchangesFrom()
    {
        return $this->hasMany(Exchange::class, 'currency_from');
    }

    public function listsExchangesTo()
    {
        return $this->hasMany(Exchange::class, 'currency_to');
    }


    public static function listCurrenciesFromInDirection()
    {
        return static::with(['listExchangesFrom', 'listExchangesTo'])->get()->where('listExchangesFrom', '!=', null);
    }

    public static function listCurrenciesToInDirection()
    {
        return static::with(['listExchangesFrom', 'listExchangesTo'])->get()->where('listExchangesTo', '!=', null);
    }

}

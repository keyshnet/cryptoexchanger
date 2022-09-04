<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'code',
        'currency_from',
        'currency_to',
        'min',
        'max',
        'course',
        'course_code',
        'auto_course_act',
        'auto_course_market',
        'auto_course_direct',
    ];

    public function currencyFrom()
    {
        return $this->belongsTo(Currencie::class, 'currency_from');
    }

    public function currencyTo()
    {
        return $this->belongsTo(Currencie::class, 'currency_to');
    }

    public function getPrice($siteDirect = true)
    {

        $price = 1;
        $reverseCourse = false;


        if($this->auto_course_act) {
            if(!$this->course_code)
                return;

            $course = Course::where('pair', $this->course_code)->where('market', $this->auto_course_market)->first();

            if(!$this->auto_course_direct && !$siteDirect)
                $reverseCourse = false;
            elseif(!$this->auto_course_direct OR !$siteDirect)
                $reverseCourse = true;

            if($course)
                $price = $course->course;


            if($reverseCourse)
                $price = 1/$price;


            if($this->auto_add_to_price)
                $price = $price+($price*$this->auto_add_to_price)/100;
        }
        else
            $price = $this->course;

//        dd($price);
        return $price;
    }

}

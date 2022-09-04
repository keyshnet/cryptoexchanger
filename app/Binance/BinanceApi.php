<?php


namespace App\Binance;


use App\Models\Course;
use App\Models\Currencie;
use App\Models\Exchange;
use GuzzleHttp\Client;

class BinanceApi
{

    public $client;

    /**
     * BinanceApi constructor.
     * @param $client
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.binance.com/api/v3/'
        ]);
    }

    public function updateCourse(){
        $currArray = [];

        $pairs = $this->getPairsForUpdate();
//        $pairs = [
//            "BTCUSDT",
//            "LTCBTC",
//            "LTCBNB",
//            "ETHBTC",
//            'BNBBTC'
//        ];

        $directions = $this->client->request('GET', 'ticker/price?symbols='.json_encode(array_values($pairs)))->getBody()->getContents();

        foreach (json_decode($directions) as $direction) {
            Course::updateOrCreate(
                ['pair' => $direction->symbol],
                ['course' => $direction->price, 'market' => 'binance']
            );
        }
    }

    public function getAllCourse(){

        $coursesReq = $this->client->request('GET', 'ticker/price')->getBody()->getContents();

        $courses = json_decode($coursesReq);

        return $courses;
    }

    public function getPairsForUpdate()
    {
        $directions = Exchange::all();
        $course_code = $directions->map(function ($item, $key) {
            return $item['course_code'];
        })->reject(function ($name) {
            return empty($name);
        })->unique()->toArray();

        return $course_code;
    }


}


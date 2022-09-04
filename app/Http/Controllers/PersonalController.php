<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Mime\Header\get;

class PersonalController extends Controller
{
    public function index(){
        $user =  Auth::user();

        $orders = Orders::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();


        return view('personal.index', [
            'user' => $user,
            'items' => $orders
        ]);

    }
}

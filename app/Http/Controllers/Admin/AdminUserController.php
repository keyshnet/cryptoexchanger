<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        foreach ($users as $u => $user) {
            $users[$u]['orders'] = Orders::where('user_id', $user->id)->get();
        }

        return view('admin.users.index', [
            'users' => $users
        ]);
    }
}

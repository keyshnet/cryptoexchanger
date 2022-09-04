<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function adminList(){
        $list = Course::all();

        return view('admin.currency.courses', [
            'items' => $list
        ]);
    }
}

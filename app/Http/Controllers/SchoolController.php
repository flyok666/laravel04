<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    public function index(){
        $schools = School::all();
        return view('school.index',compact('schools'));
    }
}

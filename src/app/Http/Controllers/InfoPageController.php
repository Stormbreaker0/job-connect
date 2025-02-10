<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoPageController extends Controller
{
    public function aboutUs(){
        return view('pages.about');
    }

    public function privacy(){
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page1() {

        return view('welcome', [
            'title' => 'page1'
        ]);
    }

    public function page2() {

        return view('welcome', [
            'title' => 'page2'
        ]);
    }
}

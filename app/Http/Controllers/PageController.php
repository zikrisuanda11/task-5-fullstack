<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke()
    {
        
    }

    public function article()
    {
        return view('article');
    }

    public function category()
    {
        return view('category');
    }
}

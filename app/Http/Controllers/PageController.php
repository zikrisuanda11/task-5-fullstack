<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

class PageController extends Controller
{
    public function __invoke()
    {
        
    }

    public function article()
    {
        $users = User::all();
        $categories = Category::all();

        return view('article', [
            'users' => $users,
            'categories' => $categories
        ]);
    }
    

    public function category()
    {
        $users = User::all();
        return view('category', [
            'users' => $users
        ]);
    }
}

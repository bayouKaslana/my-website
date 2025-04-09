<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class AdminController extends Controller
{
    public function dashboard()
    {
        $articles = Article::latest()->get(); // atau ->paginate(10)
        return view('admin.dashboard', compact('articles'));
    }
}



<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 2)->latest('id')->paginate(6);

        $data = [
            'pageTitle' => 'Web Serveces'
        ];

        return view('front-end.index', $data, compact('posts'));
    }
}

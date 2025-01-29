<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with(['image', 'tags', 'user'])->where('status', 2)->latest('id')->paginate(4);

        $data = [
            'pageTitle' => 'Web Serveces',
            'posts' => $posts,
            'categories' => $categories
        ];

        return view('front-end.index', $data);
    }
    public function show(Post $post)
    {

        $similares = Post::where('category_id', $post->category_id)->where('status', 2)->where('id', '!=', $post->id)->latest('id')->take(4)->get();

        $data = [
            'pageTitle' => 'Web Serveces-posts',
            'title' => 'Arcticulos',
            'post' => $post,
            'similares' => $similares
        ];

        return view('front-end.posts.show', $data);
    }
    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->where('status', 2)->latest('id')->paginate(3);

        return view('front-end.posts.category', compact('posts'));
    }
}
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //protected $paginationTheme = "bootstrap";

    public function index()
    {
        
        $posts = Post::with(['image', 'tags', 'user'])->where('status', 2)->latest('id')->paginate(4);

        $data = [
            'pageTitle' => 'Web Serveces',
            'posts' => $posts,
            
        ];

        return view('front-end.index', $data);
    }
    public function show(Post $post)
    {
        
        $similares = Post::where('category_id', $post->category_id)->where('status', 2)->where('id', '!=', $post->id)->latest('id')->take(4)->get(); //Brings all similar posts

        $data = [
            'pageTitle' => 'Web Serveces-article',
            'title' => 'Arcticulos',
            'post' => $post,
            'similares' => $similares,
        ];

        return view('front-end.posts.show', $data);
    }
    public function category(Category $category)
    {
        
        $posts = Post::where('category_id', $category->id)->where('status', 2)->latest('id')->paginate(3); // Filtering by id the categories
        //dd($posts);
        $data = [
            'pageTitle' => 'Web Serveces-' . $category->name,
            'posts' => $posts,
            'category' => $category,
            
        ];

        return view('front-end.posts.category', $data);
    }
    public function tag(Tag $tag)
    {
        
        $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(3);

        $data = [
            'pageTitle' => 'Web Serveces-' . $tag->name,
            'posts' => $posts,
            
            'tag' => $tag
        ];

        return view('front-end.posts.tag', $data);
    }

    public function product_list() {
       
        return view('front-end.components.product-list', [
            'pageTitle' => 'Lista de Productos',
        ]);
    }

    public function product_detail($id) {

        return view('front-end.components.product-detail', [
            'product' => Product::findOrFail($id),
            'pageTitle' => 'Lista de Productos',
        ]);
    }
}

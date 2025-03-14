<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Services\PostService;
use App\Services\ProductService;
use App\Services\SettingService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    protected $postServices;
    protected $productService;
    protected $settingService;

    public function __construct()
    {
        $this->postServices = app(PostService::class);
        $this->productService = app(ProductService::class);
        $this->settingService = app(SettingService::class);
    }

    public function index()
    {
        $posts = $this->postServices->getPaginatedPost(4);
        $settingData = $this->settingService->getAllSettings();

        $data = [
            'pageTitle' => 'Web Serveces',
            'posts' => $posts,
            'settings' => $settingData,
            'latest_products' => $this->productService->latest_active_all()->take(6)->get(),
            'last_product' => $this->productService->latest_active_all()->first(),
            'last_post' => $this->postServices->getLatestPost(),
        ];

        return view('front-end.index', $data);
    }
    public function show(Post $post)
    {
        $similares = $this->postServices->getSimilarPosts($post);

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
        
        $posts = $this->postServices->getPostsByCategory($category); 
        $data = [
            'pageTitle' => 'Web Serveces-' . $category->name,
            'posts' => $posts,
            'category' => $category,
            
        ];

        return view('front-end.posts.category', $data);
    }
    public function tag(Tag $tag)
    {
        
        $posts = $this->postServices->getPostsByTag($tag);

        $data = [
            'pageTitle' => 'Web Serveces-' . $tag->name,
            'posts' => $posts,
            
            'tag' => $tag
        ];

        return view('front-end.posts.tag', $data);
    }

    public function product_list(ProductService $productService) {
       
        return view('front-end.components.product-list', [
            'pageTitle' => 'Lista de Productos',
            'products' => $productService->latest_active(6)
        ]);
    }

    public function product_detail(Product $product) {

        return view('front-end.components.product-detail', [
            'product' => $product,
            'pageTitle' => 'Detalles del Producto',
        ]);
    }
}

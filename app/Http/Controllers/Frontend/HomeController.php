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
   
    protected $postService;
    protected $settingService;
    protected $productService;
    

    public function __construct(PostService $postService,SettingService $settingService, ProductService $productService)
    {
        $this->postService = $postService;
        $this->settingService = $settingService;
        $this->productService = $productService;
    }

    public function index()
    {
        $data = $this->postService->getIndexData();
        return view('front-end.index', $data);
    }
    public function show(Post $post)
    {
        $data = $this->postService->getShowData($post);
        return view('front-end.posts.show', $data);
    }
    public function category(Category $category)
    {

        $data = $this->postService->getCategoryData($category);
        return view('front-end.posts.category', $data);
    }
    public function tag(Tag $tag)
    {

        $data = $this->postService->getTagData($tag);

        return view('front-end.posts.tag', $data);
    }

    public function product_list() {

        $settingData = $this->settingService->getAllSettings();
        return view('front-end.components.product-list', [
            'pageTitle' => 'Lista de Productos',
            'products' => $this->productService->latest_active(6),
            'settings' => $settingData,
        ]);
    }

    public function product_detail(Product $product) {
        $settingData = $this->settingService->getAllSettings();
        return view('front-end.components.product-detail', [
            'product' => $product,
            'pageTitle' => 'Detalles del Producto',
            'settings' => $settingData,
        ]);
    }
}

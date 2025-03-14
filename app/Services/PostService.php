<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    protected $settingService;
    protected $productService;

    public function __construct()
    {
        $this->settingService = app(SettingService::class);
        $this->productService = app(ProductService::class);
    }
    public function getIndexData(): array
    {
        $posts = $this->getActivePosts(4);
        $settingData = $this->settingService->getAllSettings();

        return [
            'pageTitle' => 'Web Services',
            'posts' => $posts,
            'settings' => $settingData,
            'latest_products' => $this->productService->latest_active_all()->take(6)->get(),
            'last_product' => $this->productService->latest_active_all()->first(),
            'last_post' => $this->getLatestPost(),
        ];
    }
    public function getShowData(Post $post): array
    {
        $similares = $this->getSimilarPosts($post);

        return [
            'pageTitle' => 'Web Services - Article',
            'title' => 'Artículos',
            'post' => $post,
            'similares' => $similares,
        ];
    }
    public function getCategoryData(Category $category): array
    {
        $posts = $this->getPostsByCategory($category);

        return [
            'pageTitle' => 'Web Services - ' . $category->name,
            'posts' => $posts,
            'category' => $category,
        ];
    }
    public function getTagData(Tag $tag): array
    {
        $posts = $this->getPostsByTag($tag);

        return [
            'pageTitle' => 'Web Services - ' . $tag->name,
            'posts' => $posts,
            'tag' => $tag,
        ];
    }
    protected function getActivePosts(int $perPage)
    {
        return Post::with(['image', 'tags', 'user'])
            ->where('status', 2)
            ->latest('id')
            ->paginate($perPage);
    }
    public function getCategories()
    {
        return Category::pluck('name', 'id');
    }

    public function getTags()
    {
        return Tag::all();
    }

    public function getPaginationPosts($search='', $perPage = 6)
    {
        return Post::where('user_id', auth()->user()->id)
            ->where('name', 'like', '%' . $search . '%')
            ->latest('id')
            ->paginate($perPage);
    }
    public function getPaginatedPost($perPage = 4)
    {
        return Post::with(['image', 'tags', 'user'])->where('status', 2)->latest('id')->paginate($perPage);
    }
    public function getPost(Post $post)
    {
        return $post->load(['image','tags','user']);
    }
    public function getSimilarPosts(Post $post,$limit= 4)
    {
        return Post::where('category_id', $post->category_id)->where('status', 2)->where('id', '!=', $post->id)->latest('id')->take($limit)->get(); //Brings all similar posts
    }
    public function getPostsByCategory(Category $category,$perPage = 3)
    {
        return Post::where('category_id', $category->id)->where('status', 2)->latest('id')->paginate($perPage);
    }
    public function getPostsByTag(Tag $tag, $perPage = 3)
    {
        return $tag->posts()->where('status', 2)->latest('id')->paginate($perPage);
    }
    public function getLatestPost()
    {
        return Post::where('status', 2)->latest('id')->first();
    }
    public function generateSlug($title)
    {
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug); // Reemplazar caracteres no alfanuméricos
        $slug = preg_replace('/(^-|-$)/', '', $slug); // Eliminar guiones al inicio y al final
        return $slug;
    }

    public function createOrUpdatePost($data, $postId = null, $image = null)
    {
        $rules = PostRequest::getRules($data['status'], $postId);
        $userId = auth()->id();
        $imagePath = $image ? $image->store('posts', 'public') : null;

        DB::transaction(function () use ($postId, $userId, $imagePath, $data) {
            if ($postId) {
                // Update existing post
                $post = Post::findOrFail($postId);
                if ($imagePath) {
                    if ($post->image) {
                        Storage::delete('public/' . $post->image->url);
                        $post->image->delete();
                    }
                    $post->image()->create(['url' => $imagePath]);
                }
                $post->update($data);
            } else {
                // Create new post
                $post = Post::create([
                    ...$data,
                    'user_id' => $userId,
                ]);
                if ($imagePath) {
                    $post->image()->create(['url' => $imagePath]);
                }
            }

            // Sync tags
            $post->tags()->sync($data['selectedTags']);
        });

    }

    public function deletePost($postId)
    {
        $post = Post::find($postId)->first();
        if ($post->image) {
            Storage::delete('public/' . $post->image->url);
            $post->image->delete();
        }
        $post->delete();
    }

    public function getPostForEdit($postId)
    {
        return Post::findOrFail($postId);
    }
}

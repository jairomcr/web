<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;


class ProductService
{
    public function store(Collection $data)
    {
        $product = Product::create([
            ...$data->only(['name', 'price', 'info', 'desc', 'status']),
            'user_id' => auth()->user()->id,
            'slug' => Str::slug($data['name'])
        ]);

        $path = Storage::disk('public')->put('products', $data['img']);

        Image::create([
            'imageable_id' => $product->id,
            'imageable_type' => Product::class,
            'url' => $path
        ]);
    }

    public function update(int $id, Collection $data)
    {

        $product = Product::findOrFail($id);

        $product->update([
            ...$data->only([
                'name',
                'price',
                'info',
                'desc',
                
            ]),
            'slug' => Str::slug($data['name'])
        ]);

        if ($data['img']) {

            $deleted = Storage::disk('public')->delete($product->image->url);
            $replaced = Storage::disk('public')->put('products', $data['img']);

            throw_if(
                !($deleted && $replaced),
                new RuntimeException('Error when updating the product image')
            );

            $path = 'products/' . $data['img']->hashName();

            $product->image->url = $path;
        }

        $product->image->save();
        $product->save();
    }

    public function delete(int $id)
    {
        return Product::findOrFail($id)->delete();
    }

    public function latest()
    {
        return Product::latest('id');
    }

    public function latest_active(int $per_page)
    {
        return Product::where('status', 2)->latest('id')->paginate($per_page);
    }



    public function getSimilarProductsBy(string $column, mixed $value) {
        return Product::where($column, 'like', "%$value%");
    }

    public function find(int $id) {
        if ($id === -1) return $this->fakeProduct();

        return Product::findOrFail($id);
    }

    public function fakeProduct() {
        return Product::make([
            'name' => '',
            'price' => 0,
            'info' => '',
            'desc' => '',
            'user_id' => auth()->user()->id,
        ]);
    }

    public function set_product_status(int $id, int $newStatus) {
        $product = Product::findOrFail($id);
        $product->status = $newStatus;
        $product->save();
    }
}
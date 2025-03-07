<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getImagePaths() as $url) {
            $name = fake()->unique()->streetName();

            $product = Product::factory()->createOne([
                // Fancy (and super fake) product name
                'name' => $name,
                'info' => fake()->unique()->sentence(20),
                'desc' => fake()->realText(maxNbChars: 500),
                'price' => fake()->randomFloat(2, 100, 500),
                // All generated products are 'active'
                'status' => 2,
                'user_id' => User::all()->random()->id,
                'slug' => Str::slug($name)
            ]);

            Image::factory()->createOne([
                'url' => $url,
                'imageable_id' => $product->id,
                'imageable_type' => Product::class,
            ]);
        }
    }

    public function getImagePaths()
    {
        return Storage::disk('public')->files('products');
    }
}

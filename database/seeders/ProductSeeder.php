<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var \Illuminate\Support\Collection<string>
         */
        $paths = $this->getImagePaths();

        foreach ($paths as $path) {
            $product = Product::factory()->createOne(
                [
                    // Fancy (and super fake) product name
                    'name' => "Cerveza " . fake()->unique()->streetName(),
                    'info' => fake()->unique()->sentence(20),
                    'desc' => fake()->realText(maxNbChars: 500),
                    'price' => fake()->randomFloat(500),
                    // Make at least 70% of the values in the status column to be 1 (active)
                    // Boolean math is faster than array randomness
                    'status' => fake()->boolean(70) ? 1 : 2,
                    'user_id' => User::all()->random()->id,
                ]
            );

            $image = Image::factory()->createOne([
                'url' => $path,
                'imageable_id' => $product->id,
                'imageable_type' => Product::class
            ]);

            
        }
    }

    private function getImagePaths(): \Illuminate\Support\Collection
    {

        $fileNames = \Illuminate\Support\Facades\Storage::disk('public')->files('products');
        $imagePaths = collect([]);

        foreach ($fileNames as $fileName) {
            $imagePaths->push("storage/$fileName");
        }

        return $imagePaths;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(100)->create();

        /**
        // Cadastra 50 produtos com Factory:
        factory(Product::class, 10)->create();

// Cria 10 categorias dinâmicas (Precisa ter o factory de Category pronto. Ok?)
        factory(Category::class, 10)->create()->each(function($category) {
            // Sincroniza os produtos (3) para cada categoria
            $category->products()->sync(
                Product::all()->random(3)
            );
        });**/
    }
}

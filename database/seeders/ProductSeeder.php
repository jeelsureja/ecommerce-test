<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = app_path('Docs/products.json');
        if(file_exists($file)) {
            $products = file_get_contents($file);
            $products = json_decode($products);
            
            foreach ($products->products as $product) {
                $productName = Product::where('product_name',$product->product_name)->first();
                
                if (!empty($productName)) {
                    continue;
                } else {
                    Product::updateOrCreate([
                        'product_name' => $product->product_name ?? null,
                    ],[
                        'brand_id' => $product->brand_id,
                        'product_name' => $product->product_name ?? null,
                        'description' => $product->description ?? null,
                        'summary' => $product->summary ?? null,
                        'image' => $product->image ?? null,
                        'price' => $product->price ?? null,
                        'stock' => $product->stock ?? null,
                    ]);
                }
            }
        }
    }
}

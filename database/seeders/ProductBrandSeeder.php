<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = app_path('Docs/brand_names.json');
        if(file_exists($file)) {
            $brands = file_get_contents($file);
            $brands = json_decode($brands);
            
            foreach ($brands->product_brands as $brand) {
                $brandName = ProductBrand::where('brand_name',$brand->brand_name)->first();
                
                if (!empty($brandName)) {
                    continue;
                } else {
                    ProductBrand::updateOrCreate([
                        'brand_name' => $brand->brand_name ?? null,
                    ],[
                        'brand_name' => $brand->brand_name ?? null,
                    ]);
                }
            }
        }
    }
}

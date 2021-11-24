<?php

use App\Product;
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
       $product = Product::create([
           'color_id' => 1,
            'description' => 'ستائر بقماش عازل للشمس والأتربة من الشبابيك , ستائر الكلاديا عراقة الماضي وتكنولوجيا المستقبل مقاس 
                                200 x 250',
            'price' => 750.00,
        ]);
        
    }
}

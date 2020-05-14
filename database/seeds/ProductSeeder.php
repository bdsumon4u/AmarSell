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
        $product = factory(Product::class, 5000)->create();
        
        $images = [ '5' => ['zone' => 'base'] ];
        $i = '4,7,9';
        if($i) {
            foreach(explode(',', $i) as $additional_image) {
                $images[$additional_image] = ['zone' => 'additionals'];
            }
        }
        $product->images()->sync($images);

        $product->categories()->sync([1,3]);
    }
}

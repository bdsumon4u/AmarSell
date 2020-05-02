<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Baby Care',
                'slug' => 'baby-care',
            ],
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
            ],
            [
                'parent_id' => 2,
                'name' => 'Laptops',
                'slug' => 'laptops',
            ],
            [
                'parent_id' => 3,
                'name' => 'Apple',
                'slug' => 'apple',
            ],
            [
                'parent_id' => 3,
                'name' => 'HP',
                'slug' => 'hp',
            ],
            [
                'parent_id' => 3,
                'name' => 'Dell',
                'slug' => 'dell',
            ],
            [
                'parent_id' => 3,
                'name' => 'Acer',
                'slug' => 'acer',
            ],
            [
                'parent_id' => 2,
                'name' => 'Desktops',
                'slug' => 'desktops',
            ],
            [
                'parent_id' => 8,
                'name' => 'HP',
                'slug' => 'hp',
            ],
            [
                'parent_id' => 8,
                'name' => 'Dell',
                'slug' => 'dell',
            ],
            [
                'parent_id' => 8,
                'name' => 'Lenevo',
                'slug' => 'lenevo',
            ],
            [
                'parent_id' => 8,
                'name' => 'Asus',
                'slug' => 'asus',
            ],
            [
                'parent_id' => 2,
                'name' => 'Mobiles',
                'slug' => 'mobiles',
            ],
            [
                'parent_id' => 13,
                'name' => 'Apple',
                'slug' => 'apple',
            ],
            [
                'parent_id' => 13,
                'name' => 'Samsung',
                'slug' => 'samsung',
            ],
            [
                'parent_id' => 13,
                'name' => 'Husband',
                'slug' => 'husband',
            ],
            [
                'parent_id' => 2,
                'name' => 'Tablets',
                'slug' => 'tablets',
            ],
            [
                'parent_id' => 17,
                'name' => 'Huawei',
                'slug' => 'huawei',
            ],
            [
                'parent_id' => 17,
                'name' => 'Windows',
                'slug' => 'windows',
            ],
            [
                'parent_id' => 2,
                'name' => 'Bikes',
                'slug' => 'bikes',
            ],
            [
                'parent_id' => 20,
                'name' => 'Yamahabub',
                'slug' => 'Yamaha',
            ],
            [
                'parent_id' => 20,
                'name' => 'Discover',
                'slug' => 'discover',
            ],
            [
                'parent_id' => 20,
                'name' => 'Pulsur',
                'slug' => 'pulsur',
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
            ],
            [
                'parent_id' => 24,
                'name' => 'T-shirts',
                'slug' => 'tshirts',
            ],
            [
                'parent_id' => 24,
                'name' => 'Watches',
                'slug' => 'watches',
            ],
            [
                'parent_id' => 24,
                'name' => 'Eyewares',
                'slug' => 'eyewares',
            ],
            [
                'parent_id' => 24,
                'name' => 'Backpacks',
                'slug' => 'packbacks',
            ],
            [
                'parent_id' => 24,
                'name' => 'Sneakers',
                'slug' => 'sneakers',
            ],
        ];
        
        foreach($categories as $category) {
            Category::create($category);
        }
    }
}

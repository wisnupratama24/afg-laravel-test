<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        

        $productCategorySeeder = [
            [
                'name' => "Elektronik"
            ],
            [
                'name' => "Fashion Pria"
            ],
            [
                'name' => "Fashion Wanita"
            ]
        ];

        $warehouseSeeder = [
            [
                'name' => "Gudang Semarang",
                'locations' => 'Semarang'
            ],
            [
                'name' => "Gudang Bandung",
                'locations' => 'Bandung'
            ],
        ];
    
        DB::table('product_categories')->insert($productCategorySeeder);
        DB::table('warehouses')->insert($warehouseSeeder);

        $n = 10;
        $faker = Faker::create("id_ID");
        for($i = 0; $i < $n; $i++) {
           $product = Product::create([
                'name' => $faker->name(),
                'product_category_id' => rand(1,3),
                'price' => $faker->numberBetween(1000, 7000),
                'description' => $faker->text(),
            ]);

            DB::table('product_details')->insert([
                'stock' => rand(1,100),
                'product_id' => $product->id,
                'warehouses_id' => rand(1,2),
            ]);
        }

        User::create([
            'name' => "Wisnu Pratama",
            'email' => "wisnupratama@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
        ]);
        
    }
}

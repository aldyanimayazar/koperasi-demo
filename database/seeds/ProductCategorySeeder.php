<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            'name' => 'Gadget'
        ]);

        DB::table('product_categories')->insert([
            'name' => 'Shirt'
        ]);
    }
}

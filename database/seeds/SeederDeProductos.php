<?php

use Illuminate\Database\Seeder;

class SeederDeProductos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table("products")->insert( //estoy haciendo insert manual e individual
        //   [
        //     "category_id" => 1,
        //     "trademark_id" => 1,
        //     "name" => 'tenzendo',
        //     "description" => 'potetita de la erra',
        //     "stock" => 4,
        //     "price" => 555,
        //     "photo" => 'ZYbdb3yhaF0xnZuGM1GM5SGxQGSupmAADRlQt2nN.jpeg',
        //     "status" => 1
        //   ]
        // );
        factory(App\Product::class, 10)->create();
    }
}

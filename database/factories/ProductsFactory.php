<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\CategoryTrademark;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
  $relationsTrademarksCategories = CategoryTrademark::all();
  $categoriesId=[];
  $trademarksId=[];
  foreach ($relationsTrademarksCategories as $fila) {
    $categoriesId[]= $fila->category_id;
    $trademarksId[]= $fila->trademark_id;
  }
  $collectionCategories = collect($categoriesId);
  $collectionTrademarks = collect($trademarksId);

    return [
          "category_id" => $collectionCategories->random(),
          "trademark_id" => $collectionTrademarks->random(),
          "name" => $faker->word,
          "description" => $faker->text(5),
          "stock" => $faker->numberBetween(2, 15),
          "price" => $faker->numberBetween(250, 590),
          "photo" => 'EfGdlqakjapp7S03wcAICoYERGjLm9p4whmjptlH.png',
          "status" => 1
    ];
});

<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [
            ['name' => 'Dien Thoai'],
            ['name' => 'LAptop'],
            ['name' => 'Loa']
        ];
        Category::insert($data);

        factory(Category::class,5)->create();
    }
}

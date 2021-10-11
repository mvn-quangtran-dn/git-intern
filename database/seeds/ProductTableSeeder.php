<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[[
            'name'=> 'Product1',
            'quantity'=> 10,
            'price'=> 10000
        ],
        [
            'name'=> 'Product2',
            'quantity'=> 10,
            'price'=> 10000
        ],
        [
            'name'=> 'Product3',
            'quantity'=> 10,
            'price'=> 10000
        ]
    ];
    Product::insert($data);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Coupon::create([
            'name' => '25OFF',
            'type' => 'sale',
            'target' => 'subtotal',
            'value' => '25%',
        ]);

        Coupon::create([
            'name' => 'NEWUSER',
            'type' => 'promo',
            'target' => 'subtotal',
            'value' => '-15',
        ]);

        Coupon::create([
            'name' => 'GST',
            'type' => 'tax',
            'target' => 'subtotal',
            'value' => '7%',
        ]);

        Coupon::create([
            'name' => 'STDSHIPPING',
            'type' => 'shipping',
            'target' => 'total',
            'value' => '+5.90',
        ]);

        Coupon::create([
            'name' => 'EXPSHIPPING',
            'type' => 'shipping',
            'target' => 'total',
            'value' => '+9.90',
        ]);
    }
}

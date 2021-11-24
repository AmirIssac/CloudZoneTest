<?php

use App\Color;
use Illuminate\Database\Seeder;

class Colors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'name' => 'ابيض',
        ]);
        Color::create([
            'name' => 'اسود',
        ]);
        Color::create([
            'name' => 'احمر',
        ]);
        Color::create([
            'name' => 'اخضر',
        ]);
        Color::create([
            'name' => 'ازرق',
        ]);
        Color::create([
            'name' => 'اصفر',
        ]);
        Color::create([
            'name' => 'برتقالي',
        ]);
        Color::create([
            'name' => 'بني',
        ]);
    }
}

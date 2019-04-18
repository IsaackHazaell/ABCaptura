<?php

use Illuminate\Database\Seeder;

class ConstructionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('constructions')->insert([
            'name' => 'Tuxpan',
            'honorary' => 10,
            'date' => '16-11-2018',
            'square_meter' => 20,
            'status' => 1,
        ]);
    }
}

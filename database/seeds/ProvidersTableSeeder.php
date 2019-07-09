<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider = new App\Provider();
        $provider->name = 'Arq. Missael Quintero';
        $provider->category = 2;
        $provider->turn = 'Honorarios';
        $provider->cellphone = 3333333333;
        $provider->mail = 'missael@gmail.com';
        $provider->company = 'Arquitectura en balance';
        $provider->save();

        $address = new App\Address();
        $address->provider_id = $provider->id;
        $address->save();
    }
}

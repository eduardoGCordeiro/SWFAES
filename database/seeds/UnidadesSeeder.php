<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            [
                'nome' => 'QUILO',
                'sigla' => 'Kg'
            ],
            [
                'nome' => 'LITRO',
                'sigla' => 'L'
            ]

        ]);
    }
}

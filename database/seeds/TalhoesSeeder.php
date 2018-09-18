<?php

use Illuminate\Database\Seeder;

class TalhoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        public function run()
    {
        DB::table('talhoes')->insert([
            [
                'area' => 1000,
                'identificador'=>'A0001',
                'descricao'=>'primeiro talhão da fazenda',
                'tipo'=>'Agricultuta'
            ],
            [
                'area' => 1000,
                'identificador'=>'A0002',
                'descricao'=>'segundo talhão da fazenda',
                'tipo'=>'Agricultuta'
            ],
            [
                'area' => 1000,
                'identificador'=>'A0003',
                'descricao'=>'terceiro talhão da fazenda',
                'tipo'=>'Pecuária'
            ]
        ]);
    }
    }
}

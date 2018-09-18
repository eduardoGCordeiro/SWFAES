<?php

use Illuminate\Database\Seeder;

class TiposItensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_itens')->insert([
            [
                'nome' => 'AGRICULTURA',
            ],
            [
                'nome' => 'PECUÁRIA',
            ],
            [
                'nome' => 'MANTIMENTOS',
            ],
            [
                'nome' => 'VEÍCULOS',
            ]

        ]);
    }
}

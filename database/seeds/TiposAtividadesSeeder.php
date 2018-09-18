<?php

use Illuminate\Database\Seeder;

class TiposAtividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_atividades')->insert([
            [
                'nome' => 'AGRICULTURA',
            ],
            [
                'nome' => 'PECUÁRIA',
            ],
            [
                'nome' => 'COMPRA',
            ],
            [
                'nome' => 'VENDA',
            ]

        ]);
    }
}

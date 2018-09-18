<?php

use Illuminate\Database\Seeder;

class ItensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('itens')->insert([
            [
                'nome' => 'Item 1',
                'custo_por_unidades'=>10,
                'quantidade'=>0,
                'id_unidades_unidades'=>1
            ],
            [
                'nome' => 'Item 2',
                'custo_por_unidades'=>30,
                'quantidade'=>0,
                'id_unidades_unidades'=>2
            ],
            [
                'nome' => 'Item 3',
                'custo_por_unidades'=>30,
                'quantidade'=>0,
                'id_unidades_unidades'=>1
            ]
        ]);
    }
}

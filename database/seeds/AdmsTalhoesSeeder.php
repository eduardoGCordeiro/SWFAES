<?php

use Illuminate\Database\Seeder;

class AdmsTalhoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adms_talhoes')->insert([
            [
                'id_funcionarios_funcionarios' => 2,

            ]
        ]);
    }
}

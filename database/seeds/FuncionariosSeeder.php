<?php

use Illuminate\Database\Seeder;

class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionarios')->insert([
            [
                'cpf' => 46368373040,
                'nome' => 'USUÁRIO ADM GERAL',
                'email' => 'admgeral@teste.com',
                'acesso_sistema' => 'true',
                'login' => 'admgeral',
                'password'=>bcrypt("fazendaescola")
            ],
            [
                'cpf' => 28598758167,
                'nome' => 'USUÁRIO ADM TALHÃO',
                'email' => 'admtalhao@teste.com',
                'acesso_sistema' => 'true',
                'login' => 'admtalhão',
                'password'=>bcrypt("fazendaescola")
            ]


        ]);
    }
}

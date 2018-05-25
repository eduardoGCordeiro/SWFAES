<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioTemAtividadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario_tem_atividade', function(Blueprint $table)
		{
			$table->foreign('id_atividade_atividade', 'atividade_fk')->references('id_atividade')->on('atividade')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_funcionario_funcionario', 'funcionario_fk')->references('id_funcionario')->on('funcionario')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario_tem_atividade', function(Blueprint $table)
		{
			$table->dropForeign('atividade_fk');
			$table->dropForeign('funcionario_fk');
		});
	}

}

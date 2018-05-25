<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividade', function(Blueprint $table)
		{
			$table->integer('id_atividade', true);
			$table->date('data');
			$table->date('data_registro');
			$table->string('descricao', 100)->nullable();
			$table->integer('id_adm_agricultura_adm_geral')->nullable();
			$table->integer('id_tipo_atividade_tipo_atividade')->nullable();
			$table->smallInteger('id_cultivo_cultivo')->nullable();
			$table->integer('id_requisicao_requisicao')->nullable()->unique('atividade_uq');
			$table->integer('id_talhao_talhao')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividade');
	}

}

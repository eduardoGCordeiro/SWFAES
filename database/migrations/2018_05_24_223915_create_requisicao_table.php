<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequisicaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requisicao', function(Blueprint $table)
		{
			$table->integer('id_requisicao', true);
			$table->date('data');
			$table->string('descricao', 100)->nullable();
			$table->string('descricao_adm_geral', 100)->nullable();
			$table->integer('id_adm_geral_adm_agricultura')->nullable();
			$table->integer('id_adm_pecuaria_adm_pecuaria')->nullable();
			$table->integer('id_adm_agricultura_adm_geral')->nullable();
			$table->integer('id_requisicao_status_requisicao')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requisicao');
	}

}

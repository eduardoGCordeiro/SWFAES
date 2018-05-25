<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdmPecuariaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adm_pecuaria', function(Blueprint $table)
		{
			$table->integer('id_adm_pecuaria', true);
			$table->date('data_inicio');
			$table->date('data_fim')->nullable();
			$table->integer('id_usuario_usuario')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adm_pecuaria');
	}

}

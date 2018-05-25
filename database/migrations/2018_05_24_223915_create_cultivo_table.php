<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCultivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cultivo', function(Blueprint $table)
		{
			$table->smallInteger('id_cultivo')->primary('cultivo_pk');
			$table->date('data_inicio');
			$table->string('descricao', 100)->nullable();
			$table->date('data_fim')->nullable();
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
		Schema::drop('cultivo');
	}

}

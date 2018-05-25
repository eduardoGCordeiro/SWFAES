<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtividadeTemAnimalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atividade_tem_animal', function(Blueprint $table)
		{
			$table->integer('id_animal_animal')->nullable();
			$table->integer('id_atividade_atividade')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atividade_tem_animal');
	}

}

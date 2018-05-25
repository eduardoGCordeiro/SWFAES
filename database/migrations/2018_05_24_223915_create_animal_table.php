<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('animal', function(Blueprint $table)
		{
			$table->integer('id_animal', true);
			$table->date('data_entrada');
			$table->string('identificacao', 45);
			$table->date('data_saida')->nullable();
			$table->integer('id_especie_animal_especie_animal')->nullable();
			$table->integer('id_item_item')->nullable();
			$table->integer('id_tipo_animal_tipo_animal')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('animal');
	}

}

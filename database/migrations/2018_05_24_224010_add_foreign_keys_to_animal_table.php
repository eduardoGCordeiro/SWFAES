<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnimalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('animal', function(Blueprint $table)
		{
			$table->foreign('id_especie_animal_especie_animal', 'especie_animal_fk')->references('id_especie_animal')->on('especie_animal')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_item_item', 'item_fk')->references('id_item')->on('item')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_tipo_animal_tipo_animal', 'tipo_animal_fk')->references('id_tipo_animal')->on('tipo_animal')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('animal', function(Blueprint $table)
		{
			$table->dropForeign('especie_animal_fk');
			$table->dropForeign('item_fk');
			$table->dropForeign('tipo_animal_fk');
		});
	}

}

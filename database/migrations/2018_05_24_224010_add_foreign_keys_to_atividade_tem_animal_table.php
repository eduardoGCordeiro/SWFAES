<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadeTemAnimalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividade_tem_animal', function(Blueprint $table)
		{
			$table->foreign('id_animal_animal', 'animal_fk')->references('id_animal')->on('animal')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_atividade_atividade', 'atividade_fk')->references('id_atividade')->on('atividade')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atividade_tem_animal', function(Blueprint $table)
		{
			$table->dropForeign('animal_fk');
			$table->dropForeign('atividade_fk');
		});
	}

}

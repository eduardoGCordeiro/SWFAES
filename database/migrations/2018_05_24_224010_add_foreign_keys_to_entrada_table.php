<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntradaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entrada', function(Blueprint $table)
		{
			$table->foreign('id_item_item', 'item_fk')->references('id_item')->on('item')->onUpdate('CASCADE')->onDelete('SET NULL');
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
		Schema::table('entrada', function(Blueprint $table)
		{
			$table->dropForeign('item_fk');
			$table->dropForeign('atividade_fk');
		});
	}

}

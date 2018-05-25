<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item', function(Blueprint $table)
		{
			$table->foreign('id_unidade_unidade', 'unidade_fk')->references('id_unidade')->on('unidade')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_tipo_item_tipo_item', 'tipo_item_fk')->references('id_tipo_item')->on('tipo_item')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('item', function(Blueprint $table)
		{
			$table->dropForeign('unidade_fk');
			$table->dropForeign('tipo_item_fk');
		});
	}

}

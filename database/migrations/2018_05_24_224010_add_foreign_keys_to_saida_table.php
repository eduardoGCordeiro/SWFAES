<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSaidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('saida', function(Blueprint $table)
		{
			$table->foreign('id_item_item', 'item_fk')->references('id_item')->on('item')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('saida', function(Blueprint $table)
		{
			$table->dropForeign('item_fk');
		});
	}

}

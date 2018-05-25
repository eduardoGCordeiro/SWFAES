<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item', function(Blueprint $table)
		{
			$table->integer('id_item', true);
			$table->string('nome', 46);
			$table->float('custo_por_unidade', 10, 0);
			$table->integer('id_unidade_unidade')->nullable();
			$table->integer('id_tipo_item_tipo_item')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntradaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entrada', function(Blueprint $table)
		{
			$table->integer('id_entrada', true);
			$table->float('quantidade', 10, 0);
			$table->float('custo', 10, 0);
			$table->string('descricao', 45);
			$table->integer('id_item_item')->nullable();
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
		Schema::drop('entrada');
	}

}

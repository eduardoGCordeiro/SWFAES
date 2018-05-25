<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saida', function(Blueprint $table)
		{
			$table->smallInteger('id_saida')->primary('saida_pk');
			$table->float('custo', 10, 0);
			$table->float('quantidade', 10, 0);
			$table->string('descricao', 45)->nullable();
			$table->integer('id_item_item')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('saida');
	}

}

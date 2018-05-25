<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCultivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cultivo', function(Blueprint $table)
		{
			$table->foreign('id_talhao_talhao', 'talhao_fk')->references('id_talhao')->on('talhao')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cultivo', function(Blueprint $table)
		{
			$table->dropForeign('talhao_fk');
		});
	}

}

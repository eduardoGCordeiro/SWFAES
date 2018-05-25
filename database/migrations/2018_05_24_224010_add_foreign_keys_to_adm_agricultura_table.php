<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdmAgriculturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('adm_agricultura', function(Blueprint $table)
		{
			$table->foreign('id_usuario_usuario', 'usuario_fk')->references('id_usuario')->on('usuario')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('adm_agricultura', function(Blueprint $table)
		{
			$table->dropForeign('usuario_fk');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRequisicaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requisicao', function(Blueprint $table)
		{
			$table->foreign('id_adm_geral_adm_agricultura', 'adm_agricultura_fk')->references('id_adm_geral')->on('adm_agricultura')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_adm_pecuaria_adm_pecuaria', 'adm_pecuaria_fk')->references('id_adm_pecuaria')->on('adm_pecuaria')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_adm_agricultura_adm_geral', 'adm_geral_fk')->references('id_adm_agricultura')->on('adm_geral')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_requisicao_status_requisicao', 'status_requisicao_fk')->references('id_requisicao')->on('status_requisicao')->onUpdate('CASCADE')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requisicao', function(Blueprint $table)
		{
			$table->dropForeign('adm_agricultura_fk');
			$table->dropForeign('adm_pecuaria_fk');
			$table->dropForeign('adm_geral_fk');
			$table->dropForeign('status_requisicao_fk');
		});
	}

}

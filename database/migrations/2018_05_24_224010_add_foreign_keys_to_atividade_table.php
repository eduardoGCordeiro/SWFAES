<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAtividadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atividade', function(Blueprint $table)
		{
			$table->foreign('id_adm_agricultura_adm_geral', 'adm_geral_fk')->references('id_adm_agricultura')->on('adm_geral')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_tipo_atividade_tipo_atividade', 'tipo_atividade_fk')->references('id_tipo_atividade')->on('tipo_atividade')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_cultivo_cultivo', 'cultivo_fk')->references('id_cultivo')->on('cultivo')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_requisicao_requisicao', 'requisicao_fk')->references('id_requisicao')->on('requisicao')->onUpdate('CASCADE')->onDelete('SET NULL');
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
		Schema::table('atividade', function(Blueprint $table)
		{
			$table->dropForeign('adm_geral_fk');
			$table->dropForeign('tipo_atividade_fk');
			$table->dropForeign('cultivo_fk');
			$table->dropForeign('requisicao_fk');
			$table->dropForeign('talhao_fk');
		});
	}

}

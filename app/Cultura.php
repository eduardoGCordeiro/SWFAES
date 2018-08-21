<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cultura extends Model
{
	protected $table = 'culturas';
	protected $primaryKey = 'id_culturas';
	public $timestamps = false;


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'data_inicio','data_fim','descricao','tipos_safra','id_talhoes_talhoes'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	    //
	];
}

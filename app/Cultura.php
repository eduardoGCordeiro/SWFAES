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
	    'data_inicio','data_fim','descricao','tipo_safra','id_talhoes_talhoes'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	    //
	];

	public function talhao(){
	    return $this->belongsTo('App\Talhao','id_talhoes_talhoes');
    }

    public function atividades(){
	    return $this->hasMany('App\Atividade','id_culturas_culturas');
    }
}

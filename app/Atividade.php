<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
   protected $table = 'atividades';
   protected $primaryKey = 'id_atividades';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "data","data_registro","descricao","id_adms_geral_adms_geral","id_tipos_atividades_tipos_atividades","id_culturas_culturas","id_requisicoes_requisicoes","id_talhoes_talhoes"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [ ];

    public function movimentacao()
    {
        return $this->hasMany('App\Movimentacao','id_atividades_atividades');

    }

    // public function talhoes(){
    //     return $this->belongsTo('App\Talhao');
    // }


    public function talhao()
    {
        return $this->hasOne('App\Talhao','id_talhoes','id_talhoes_talhoes');
    }

    public function cultura()
    {
        return $this->hasOne('App\Cultura','id_culturas','id_culturas_culturas');
    }

    public function tipo_atividade()
    {
        return $this->hasOne('App\TipoAtividades','id_tipos_atividades','id_culturas_culturas');
    }

    public function adms_gerais()
    {
        return $this->belongsTo('App\AdmGeral');
    }

    public function tipos_atividades()
    {
        return $this->belongsTo('App\TipoAtividades', 'id_tipos_atividades_tipos_atividades');
    }

}

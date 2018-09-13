<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmTalhao extends Model
{
    protected $table = 'adms_talhoes';
   protected $primaryKey = 'id_adms_talhoes';
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "data_inicio","data_fim","id_funcionarios_funcionarios"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];

    public function talhoes()
    {
        return $this->hasMany('App\Talhao', 'id_adms_talhoes_adms_talhoes');
    }

    public function funcionarios(){
        return $this->belongsTo('App\Funcionario', 'id_funcionarios_funcionarios');
    }
}

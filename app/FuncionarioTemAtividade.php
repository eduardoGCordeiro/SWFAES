<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncionarioTemAtividade extends Model
{
    protected $table = 'funcionario_tem_atividade';
   protected $primaryKey = ['id_funcionario_tem_atividade'];
   public $timestamps = false;


   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      "id_atividades_atividades","id_funcionarios_funcionarios"
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [ ];

}

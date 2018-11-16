<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class Funcionario extends Authenticatable
{
     use Notifiable;

    protected $table = 'funcionarios';
    protected $primaryKey = 'id_funcionarios';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf','nome','email', 'acesso_sistema', 'login','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    public function sendPasswordResetNotification($token)
    {
        // Não esquece: use App\Notifications\ResetPassword;
        $this->notify(new ResetPassword($token));
    }


    public function talhoes(){
        return $this->hasMany('App\Talhoes');

    // public function adms_talhoes(){
    //     return $this->hasMany('App\AdmTalhao','id_funcionarios_funcionarios');

    }

    public function AdmGeral(){
        return $this->hasOne('App\AdmGeral','id_funcionarios_funcionarios','id_funcionarios');
    }
}

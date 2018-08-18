<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talhao extends Model
{
    protected $table = 'talhao';
    protected $primaryKey = 'id_talhoes';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area','descricao'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];


    public function culturas()
    {
        return $this->hasMany('App\Cultura','id_talhoes_talhoes');
    }


}

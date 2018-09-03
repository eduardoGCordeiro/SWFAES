<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talhao extends Model
{
    protected $table = 'talhoes';
    protected $primaryKey = 'id_talhoes';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificador','area','descricao','tipo'
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caderneta extends Model
{
    protected $table = 'cadernetas';
    protected $primaryKey = 'id_cadernetas';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];
}

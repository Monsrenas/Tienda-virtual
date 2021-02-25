<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Almacen extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'almacenes';
    protected $fillable = [
							'codigo',
              				'nombre'
    					  ];

   public function existencia()
    {
        return $this->hasMany(Inventario::class, 'almacen', 'codigo');
        //return $this->belongsToMany(Inventario::class, '_id', 'codigo_id');
    } 					  
}
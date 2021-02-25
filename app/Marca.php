<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Marca extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'marcas';
    protected $primaryKey = 'id_marca';
    protected $fillable = [
							'id_marca',
							'nombre' 
							 
    ];


    public function modelos()
      {
          return $this->hasMany(Modelo::class,'id_marca');
      }
}

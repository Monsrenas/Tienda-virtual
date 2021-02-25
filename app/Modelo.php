<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Modelo extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'modelos';
     
    protected $fillable = [
              'id_marca',
							'id_modelo',
							'nombre'
    ];   


   public function marca()
      {
          return $this->belongsTo(Marca::class,'id_marca');
      }

   public function versiones()
      {
          return $this->hasMany(Version::class,'id_modelo');
      }

}

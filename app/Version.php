<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Version extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'versiones';
    protected $primaryKey = 'id_modelo';
    protected $fillable = [
							'id_modelo',
                            'id_version',
							'motor',
                            'cilindraje',
                            'inicio',
                            'fin', 
							'descripcion'
    ];

    public function modelos()
      {
          return $this->belongsTo(Modelo::class,'id_modelo');
      }
}

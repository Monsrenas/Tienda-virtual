<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Empresa extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'empresa';
    protected $fillable = [
							'RUC',      
              'nombre',
              'nombre_comercial',
              'telefono',
              'direccion',
              'provincia',
              'canton',
              'correo',
              'whatsapp',
              'IVA',
              'firebase',
              'logo'
              
    ];
}
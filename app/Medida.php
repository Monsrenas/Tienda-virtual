<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Medida extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'medidas';
    protected $primaryKey = 'codigo';
    protected $fillable = [
							'codigo',
              				'nombre'
    					  ];
}
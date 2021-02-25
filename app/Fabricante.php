<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Fabricante extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'fabricantes';
    protected $primaryKey = 'codigo';
    protected $fillable = [
							'codigo',
              				'nombre'
    					  ];
}
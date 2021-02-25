<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Categoria extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'categorias';
    protected $primaryKey = 'codigo';
    protected $fillable = [
							'codigo',
              				'nombre'
   						];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Configuracion extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'configuracion';
  
    protected $fillable = [
							'config' 
   						];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Descuento extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'descuentos';
    protected $fillable = [
                      'nombre',
                      'inicio',
                      'final',
                      'valor',
                      'condiciones'
              ];
}
?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pre_recepcion extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'pre_recepcion';
    
    protected $fillable = [
              'usuario',
              'proveedor',
							'documento',
              'fecha',
              'almacen',
              'codigo',
              'codigo_id',
              'cantidad',
              'costo',
              'utilidad',
              'precio'
    ];

      public function producto()
      {
          return $this->belongsTo(Producto::class, 'codigo','codigo');
      }

      public function almacenes()
      {
          return $this->belongsTo(Almacen::class, 'almacen','codigo');
      }

      public function proveedores()
      {
          return $this->belongsTo(Persona::class, 'proveedor','_id');
      }

}
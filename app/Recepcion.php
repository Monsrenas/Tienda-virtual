<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Recepcion extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'recepcion';
    protected $primaryKey = 'codigo';
    protected $fillable = [
              'id',
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
              'precio',
    ];

      public function detalles()
      {
          return $this->belongsTo(Producto::class, 'codigo','codigo');
      }

      public function persona()
      {
          return $this->belongsTo(Usuario::class,'usuario','_id');
      }

      public function proveedores()
      {
          return $this->belongsTo(Persona::class, 'proveedor','_id');
      }

      public function almacenes()
      {
          return $this->belongsTo(Almacen::class, 'almacen','codigo');
      }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Inventario extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'inventarios';
    protected $primaryKey = 'codigo_id';
    protected $fillable = [
							'codigo',
              'codigo_id',
              'producto',
							'almacen',
							'precio',
              'cantidad',
              'fisico'
    					  ];
              
                
   public function detalles()
      {
          return $this->belongsTo(Producto::class, 'codigo_id', '_id');
      }

   public function almacenes()
      {
          return $this->belongsTo(Almacen::class, 'almacen','codigo');
      }   

}
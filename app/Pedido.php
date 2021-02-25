<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pedido extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'pedidos';
    protected $fillable = [
							'codigo',      
              'fecha_facturado',
              'id_cliente',
              'forma_pago',
              'estado',
              'productos',
              'valor'
    ];

public function Cliente()
      {
          return $this->belongsTo(Persona::class,'id_cliente','_id');
      }



}


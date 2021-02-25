<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Factura extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'facturas';
    protected $fillable = [
							'codigo',      
              'id_pedido',
              'id_cliente',
              'id_vendedor',
              'forma_pago',
              'documento_pago',
              'descuento',
              'IVA',
              'productos'
    ];

    public function Cliente()
      {
          return $this->belongsTo(Persona::class,'id_cliente','_id');
      }

      public function Vendedor()
      {
          return $this->belongsTo(Usuario::class,'id_vendedor','_id');
      }
}

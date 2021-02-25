<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Venta extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'ventas';
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
}

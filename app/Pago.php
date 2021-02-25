<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Pago extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'pagos';
    protected $fillable = [
              'id_pedido',
			        'transaccion',
              'comprobante',
              'imagen',
              'valor',
              'usado',
              'factura',
              'valido',
              'id_vendedor',
    ];
}

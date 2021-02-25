<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cancelacion extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'cancalaciones';
    protected $fillable = [
              'motivo',
							'codigo',      
              'id_pedido',
              'id_cliente',
              'id_vendedor',
              'id_cancelador',
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

      public function Cancelador()
      {
          return $this->belongsTo(Usuario::class,'id_cancelador','_id');
      }      

}

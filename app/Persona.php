<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Persona extends Authenticatable
{
    //
    use Notifiable;
    protected $connection = 'mongodb';
    protected $collection = 'personas';
    protected $fillable = [
							        'id',
                      'rol',
              				'nombre',
              				'email',
                      'idpersonal',
                      'telefono',
                      'direccion',
                      'provincia',
                      'canton',
                      'estado',
                      'descuento'

   						];
}
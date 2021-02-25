<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Usuario extends Authenticatable
{
    //
    use Notifiable;
    protected $connection = 'mongodb';
    protected $collection = 'usuarioss';
    protected $primarykey = 'id';
    protected $fillable = [
							        'id',
                      'rol',
              				'nombre',
              				'email',
              				'password',
                      'idpersonal',
                      'telefono',
                      'direccion',
                      'acceso',
                      'estado'

   						];
}
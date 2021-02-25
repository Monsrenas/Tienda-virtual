<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Producto extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'productos';
    protected $primaryKey = 'codigo';
    protected $fillable = [
							'codigo',
              'codigosAd',
              'nombre',
              'descripciones',
              'medidas',
              'fabricante',
              'categorias',
              'modelos',
              'fotos'
    ];


    public function fabricantes()
      {
          return $this->belongsTo(Fabricante::class,'fabricante','codigo');
      }

    public function categoria_detalle()
      {
          return $this->belongsTo(Categoria::class,'categorias','codigo');
      }  
   
    public function existencia()
    {
        return $this->hasMany(Inventario::class, 'codigo_id', '_id');
        //return $this->belongsToMany(Inventario::class, '_id', 'codigo_id');
    }
      
}
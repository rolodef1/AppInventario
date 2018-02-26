<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
	protected $fillable = [
        'nombre', 'descripcion', 'codigo'
    ];

    protected $guarded = [
        'imagen', 'aula_id'
    ];

    public function aula()
	{	
		return $this->belongsTo('App\Aula');
	}

    public function getImagenAttribute($value)
    {
        return asset('storage/'.$value);
    }
}

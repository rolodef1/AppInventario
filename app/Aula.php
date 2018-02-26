<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
	protected $fillable = [
        'campus', 'piso', 'aula',
    ];

    public function articulos()
	{
		return $this->hasMany('App\Articulo');
	}
}

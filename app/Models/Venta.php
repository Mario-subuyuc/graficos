<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'fecha',
        'total',
        'articulo',
        'cantidad',
        'metodo_pago',
        'cliente'
    ];
    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Relaciona el user_id de ventas con el id de users
    }
}

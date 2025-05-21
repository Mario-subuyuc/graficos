<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserSession extends Model
{
    // Verifica si hay una base de datos seleccionada en la sesión y cambia la conexión
    protected $connection;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Verifica si hay una base de datos seleccionada en la sesión y cambia la conexión
        if (Session::has('database')) {
            $this->setConnection(Session::get('database'));
        }
    }
    
    protected $fillable = ['id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}




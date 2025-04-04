<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSession extends Model
{
    protected $fillable = ['id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}




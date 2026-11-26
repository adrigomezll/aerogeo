<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';

    // La tabla no tiene created_at / updated_at
    public $timestamps = false;

    protected $fillable = ['nombre', 'correo', 'contrasena'];

    protected $hidden = ['contrasena'];

    // Laravel espera una columna "password"; la tuya se llama "contrasena"
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // La tabla no tiene remember_token
    public function getRememberTokenName()
    {
        return '';
    }
}
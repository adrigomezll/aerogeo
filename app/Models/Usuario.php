<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';
    public $timestamps = false;
    protected $fillable = ['nombre', 'correo', 'contrasena'];

    public function getAuthPassword(): string
    {
        return (string) $this->contrasena;
    }

}

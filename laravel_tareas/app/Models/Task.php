<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    const UPDATED_AT = null;

    protected $fillable = [
        'usuario_id',
        'titulo',
        'descripcion',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}

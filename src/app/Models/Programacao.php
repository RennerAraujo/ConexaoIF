<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programacao extends Model
{
    use HasFactory;

    protected $table = 'programacoes';

    protected $fillable = [
        'usuario_id',
        'titulo',
        'data_inicio',
        'data_final',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'data_inicio' => 'date',
        'data_final' => 'date',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    public function noticias(): HasMany
    {
        return $this->hasMany(Noticia::class);
    }


    public function telas(): BelongsToMany
    {
        return $this->belongsToMany(Tela::class, 'tela_programacao');
    }
}
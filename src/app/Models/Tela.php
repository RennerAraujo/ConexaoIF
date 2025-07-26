<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // 1. Importe a classe do relacionamento

class Tela extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'localizacao',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Define o relacionamento: Uma Tela PODE TER MUITAS Programações.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function programacoes(): BelongsToMany
    {
        // 2. Adicione este método, especificando o nome da tabela pivot
        return $this->belongsToMany(Programacao::class, 'tela_programacao');
    }
}

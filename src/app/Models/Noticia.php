<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Noticia extends Model
{
    use HasFactory;
    protected $table = 'noticias';
    protected $fillable = [
        'programacao_id',
        'titulo',
        'texto',
        'imagem_path_1',
        'imagem_path_2',
        'imagem_path_3',
        'imagem_path_4',
        'imagem_path_5',
    ];
    public function programacao(): BelongsTo
    {
        return $this->belongsTo(Programacao::class);
    }
}
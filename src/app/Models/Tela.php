<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


class Tela extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'localizacao',
        'status',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($tela) {
            $tela->slug = Str::slug($tela->nome);
        });
    }
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function programacoes(): BelongsToMany
    {
        return $this->belongsToMany(Programacao::class, 'tela_programacao');
    }
}

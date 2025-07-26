<?php

namespace App\Http\Controllers;

use App\Models\Tela;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    /**
     * Mostra a programação ativa para uma tela específica.
     */
    public function show(Tela $tela)
    {
        // Pega a data de hoje para comparação
        $hoje = Carbon::today();

        // Procura pela primeira programação que cumpra todas as condições:
        $programacaoAtiva = $tela->programacoes()
            ->where('status', 1)
            ->where('data_inicio', '<=', $hoje)
            ->where('data_final', '>=', $hoje)
            ->with('noticias') // Já carrega as notícias para otimizar a performance
            ->first();

        // Envia a programação encontrada (ou null, se não encontrar) para a view
        return view('display.show', compact('programacaoAtiva'));
    }
}
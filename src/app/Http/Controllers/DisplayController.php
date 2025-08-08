<?php

namespace App\Http\Controllers;

use App\Models\Tela;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayController extends Controller
{

    public function show(Tela $tela)
    {
        $hoje = Carbon::today();

        $programacaoAtiva = $tela->programacoes()
            ->where('status', 1)
            ->where('data_inicio', '<=', $hoje)
            ->where('data_final', '>=', $hoje)
            ->with('noticias')
            ->first();

        return view('display.show', compact('programacaoAtiva'));
    }
}
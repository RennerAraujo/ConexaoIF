<?php

namespace App\Http\Controllers;

use App\Models\Programacao;
use App\Models\Tela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramacaoController extends Controller
{
    public function index()
    {
        $programacoes = Programacao::with('usuario')->latest()->paginate(10);
        return view('programacoes.index', compact('programacoes'));
    }

    public function create()
    {
        return view('programacoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_final' => 'required|date|after_or_equal:data_inicio',
            'status' => 'required|boolean',
        ]);

        Programacao::create([
            'titulo' => $request->titulo,
            'data_inicio' => $request->data_inicio,
            'data_final' => $request->data_final,
            'status' => $request->status,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('programacoes.index')
            ->with('success', 'Programação cadastrada com sucesso.');
    }

    public function show(Programacao $programacao)
    {
        return redirect()->route('programacoes.edit', $programacao);
    }

    // Garanta que a variável aqui é $programacao
    public function edit(Programacao $programacao)
    {
        $telas = Tela::where('status', 1)->orderBy('nome')->get();
        return view('programacoes.edit', compact('programacao', 'telas'));
    }

    // Garanta que a variável aqui é $programacao
    public function update(Request $request, Programacao $programacao)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_final' => 'required|date|after_or_equal:data_inicio',
            'status' => 'required|boolean',
            'telas' => 'nullable|array',
            'telas.*' => 'exists:telas,id',
        ]);

        $programacao->update($request->only(['titulo', 'data_inicio', 'data_final', 'status']));
        $programacao->telas()->sync($request->input('telas', []));

        return redirect()->route('programacoes.index')
            ->with('success', 'Programação atualizada com sucesso.');
    }

    // Garanta que a variável aqui é $programacao
    public function destroy(Programacao $programacao)
    {
        $programacao->telas()->detach();
        foreach ($programacao->noticias as $noticia) {
            $noticia->delete();
        }
        $programacao->delete();

        return redirect()->route('programacoes.index')
            ->with('success', 'Programação e todas as suas notícias foram excluídas com sucesso.');
    }
}
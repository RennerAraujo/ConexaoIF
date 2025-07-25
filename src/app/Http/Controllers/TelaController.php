<?php

namespace App\Http\Controllers;

use App\Models\Tela;
use Illuminate\Http\Request;

class TelaController extends Controller
{

    public function index()
    {
        $telas = Tela::latest()->paginate(10);
        return view('telas.index', compact('telas'));
    }


    public function create()
    {
        return view('telas.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'localizacao' => 'required|string|max:100',
            'status' => 'required|boolean',
        ]);

        Tela::create($request->all());

        return redirect()->route('telas.index')
            ->with('success', 'Tela cadastrada com sucesso.');
    }


    public function edit(Tela $tela) // O Laravel automaticamente encontra a Tela pelo ID na URL
    {
        return view('telas.edit', compact('tela'));
    }


    public function update(Request $request, Tela $tela)
    {
        // Valida os dados
        $request->validate([
            'nome' => 'required|string|max:100',
            'localizacao' => 'required|string|max:100',
            'status' => 'required|boolean',
        ]);

        // Atualiza a tela
        $tela->update($request->all());

        return redirect()->route('telas.index')
            ->with('success', 'Tela atualizada com sucesso.');
    }


    public function destroy(Tela $tela)
    {
        $tela->delete();

        return redirect()->route('telas.index')
            ->with('success', 'Tela excluída com sucesso.');
    }
}
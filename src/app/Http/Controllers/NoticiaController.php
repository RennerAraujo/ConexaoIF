<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Programacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{

    public function index()
    {
        $noticias = Noticia::with('programacao')->latest()->paginate(10);
        return view('noticias.index', compact('noticias'));
    }


    public function create()
    {
        $programacoes = Programacao::where('status', 1)->orderBy('titulo')->get();
        return view('noticias.create', compact('programacoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'texto' => 'nullable|string|max:850',
            'programacao_id' => 'required|exists:programacoes,id',
            'imagem_path_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['titulo', 'texto', 'programacao_id']);

        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'imagem_path_' . $i;
            if ($request->hasFile($fieldName)) {
                $path = $request->file($fieldName)->store('noticias', 'public');
                $data[$fieldName] = $path;
            }
        }

        Noticia::create($data);

        return redirect()->route('noticias.index')
            ->with('success', 'Notícia cadastrada com sucesso.');
    }


    public function edit(Noticia $noticia)
    {
        $programacoes = Programacao::where('status', 1)->orderBy('titulo')->get();
        return view('noticias.edit', compact('noticia', 'programacoes'));
    }


    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'texto' => 'nullable|string|max:850',
            'programacao_id' => 'required|exists:programacoes,id',
            'imagem_path_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['titulo', 'texto', 'programacao_id']);

        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'imagem_path_' . $i;
            $removeFieldName = 'remover_' . $fieldName;

            if ($request->hasFile($fieldName)) {
                if ($noticia->$fieldName) {
                    Storage::disk('public')->delete($noticia->$fieldName);
                }
                $path = $request->file($fieldName)->store('noticias', 'public');
                $data[$fieldName] = $path;
            } elseif ($request->has($removeFieldName)) {
                if ($noticia->$fieldName) {
                    Storage::disk('public')->delete($noticia->$fieldName);
                }
                $data[$fieldName] = null;
            }
        }

        $noticia->update($data);

        return redirect()->route('noticias.index')
            ->with('success', 'Notícia atualizada com sucesso.');
    }

    public function destroy(Noticia $noticia)
    {
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'imagem_path_' . $i;
            if ($noticia->$fieldName) {
                Storage::disk('public')->delete($noticia->$fieldName);
            }
        }

        $noticia->delete();

        return redirect()->route('noticias.index')
            ->with('success', 'Notícia excluída com sucesso.');
    }
}

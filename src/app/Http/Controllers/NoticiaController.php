<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Programacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Mostra uma lista de todas as notícias.
     */
    public function index()
    {
        $noticias = Noticia::with('programacao')->latest()->paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    /**
     * Mostra o formulário para criar uma nova notícia.
     */
    public function create()
    {
        $programacoes = Programacao::where('status', 1)->orderBy('titulo')->get();
        return view('noticias.create', compact('programacoes'));
    }

    /**
     * Salva uma nova notícia no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'nullable|string|max:350',
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

    /**
     * Mostra o formulário para editar uma notícia existente.
     */
    public function edit(Noticia $noticia)
    {
        $programacoes = Programacao::where('status', 1)->orderBy('titulo')->get();
        return view('noticias.edit', compact('noticia', 'programacoes'));
    }

    /**
     * Atualiza uma notícia no banco de dados.
     */
    public function update(Request $request, Noticia $noticia)
    {
        // 1. Valida os dados de texto e os novos ficheiros de imagem
        $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'nullable|string|max:350',
            'programacao_id' => 'required|exists:programacoes,id',
            'imagem_path_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagem_path_5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Pega os dados de texto do formulário
        $data = $request->only(['titulo', 'texto', 'programacao_id']);

        // 3. Loop para processar cada uma das 5 imagens
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = 'imagem_path_' . $i;
            $removeFieldName = 'remover_' . $fieldName;

            // CASO A: Um novo ficheiro foi enviado para este campo
            if ($request->hasFile($fieldName)) {
                // Apaga a imagem antiga do armazenamento, se ela existir
                if ($noticia->$fieldName) {
                    Storage::disk('public')->delete($noticia->$fieldName);
                }
                // Guarda a nova imagem e atualiza o caminho no array de dados
                $path = $request->file($fieldName)->store('noticias', 'public');
                $data[$fieldName] = $path;
            }
            // CASO B: Nenhum ficheiro novo foi enviado, mas a checkbox "remover" foi marcada
            elseif ($request->has($removeFieldName)) {
                // Apaga a imagem antiga do armazenamento, se ela existir
                if ($noticia->$fieldName) {
                    Storage::disk('public')->delete($noticia->$fieldName);
                }
                // Define o caminho no banco de dados como nulo
                $data[$fieldName] = null;
            }
        }

        // 4. Atualiza o registo da notícia no banco de dados com todos os novos dados
        $noticia->update($data);

        // 5. Redireciona de volta para a lista com uma mensagem de sucesso
        return redirect()->route('noticias.index')
            ->with('success', 'Notícia atualizada com sucesso.');
    }

    /**
     * Remove uma notícia do banco de dados.
     */
    public function destroy(Noticia $noticia)
    {
        // Apaga os ficheiros de imagem do armazenamento antes de apagar o registo
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Notícia') }}: {{ $noticia->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('noticias.update', $noticia) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <x-input-label for="programacao_id" value="Associar à Programação" />
                            <select name="programacao_id" id="programacao_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Selecione uma programação</option>
                                @foreach ($programacoes as $programacao)
                                    <option value="{{ $programacao->id }}" @selected(old('programacao_id', $noticia->programacao_id) == $programacao->id)>
                                        {{ $programacao->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="titulo" value="Título da Notícia" />
                            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo', $noticia->titulo)" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="texto" value="Texto (até 350 caracteres)" />
                            <textarea id="texto" name="texto" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('texto', $noticia->texto) }}</textarea>
                        </div>
                        
                        <div class="mt-6">
                            <x-input-label value="Imagens" />
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @php $fieldName = 'imagem_path_' . $i; @endphp
                                    <div class="border p-4 rounded-md">
                                        <label for="{{ $fieldName }}" class="block font-medium text-sm text-gray-700">Imagem {{ $i }}</label>
                                        
                                        @if ($noticia->$fieldName)
                                            <div class="mt-2">
                                                <img src="{{ Storage::url($noticia->$fieldName) }}" alt="Imagem {{ $i }}" class="rounded-md max-h-48 w-full object-cover">
                                                
                                                <div class="mt-2 flex items-center">
                                                    <input type="checkbox" name="remover_{{ $fieldName }}" id="remover_{{ $fieldName }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                    <label for="remover_{{ $fieldName }}" class="ml-2 block text-sm text-gray-900">Remover imagem atual</label>
                                                </div>
                                            </div>
                                        @endif

                                        <input id="{{ $fieldName }}" class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="{{ $fieldName }}">
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Atualizar Notícia
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
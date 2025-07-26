<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Nova Notícia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- enctype é obrigatório para upload de ficheiros --}}
                    <form method="POST" action="{{ route('noticias.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-4">
                            <x-input-label for="programacao_id" value="Associar à Programação" />
                            <select name="programacao_id" id="programacao_id"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                                <option value="">Selecione uma programação</option>
                                @foreach ($programacoes as $programacao)
                                    <option value="{{ $programacao->id }}">{{ $programacao->titulo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="titulo" value="Título da Notícia" />
                            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
                                :value="old('titulo')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="texto" value="Texto (até 350 caracteres)" />
                            <textarea id="texto" name="texto" rows="4"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('texto') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="imagem_path_1" value="Imagens (até 5)" />
                            <input id="imagem_path_1" class="block mt-1 w-full" type="file" name="imagem_path_1">
                            <input id="imagem_path_2" class="block mt-1 w-full" type="file" name="imagem_path_2">
                            <input id="imagem_path_3" class="block mt-1 w-full" type="file" name="imagem_path_3">
                            <input id="imagem_path_4" class="block mt-1 w-full" type="file" name="imagem_path_4">
                            <input id="imagem_path_5" class="block mt-1 w-full" type="file" name="imagem_path_5">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Cadastrar Notícia
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
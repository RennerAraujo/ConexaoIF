<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tela') }}: {{ $tela->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Formulário aponta para a rota de update e usa o método PUT --}}
                    <form method="POST" action="{{ route('telas.update', $tela) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nome -->
                        <div>
                            <label for="nome" class="block font-medium text-sm text-gray-700">Nome</label>
                            {{-- O valor do campo é preenchido com os dados existentes --}}
                            <input id="nome" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text"
                                name="nome" value="{{ old('nome', $tela->nome) }}" required autofocus />
                        </div>

                        <!-- Localização -->
                        <div class="mt-4">
                            <label for="localizacao" class="block font-medium text-sm text-gray-700">Localização</label>
                            <input id="localizacao" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                type="text" name="localizacao" value="{{ old('localizacao', $tela->localizacao) }}"
                                required />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                {{-- Lógica para selecionar a opção correta com base no status atual --}}
                                <option value="1" @if(old('status', $tela->status) == 1) selected @endif>Ativa</option>
                                <option value="0" @if(old('status', $tela->status) == 0) selected @endif>Inativa</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
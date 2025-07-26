<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Programação') }}: {{ $programacao->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('programacoes.update', $programacao) }}">

                        @csrf
                        @method('PUT')

                        <!-- Título -->
                        <div>
                            <x-input-label for="titulo" value="Título" />
                            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
                                :value="old('titulo', $programacao->titulo)" required autofocus />
                        </div>

                        <!-- Data Início -->
                        <div class="mt-4">
                            <x-input-label for="data_inicio" value="Data de Início" />
                            <x-text-input id="data_inicio" class="block mt-1 w-full" type="date" name="data_inicio"
                                :value="old('data_inicio', $programacao->data_inicio->format('Y-m-d'))" required />
                        </div>

                        <!-- Data Final -->
                        <div class="mt-4">
                            <x-input-label for="data_final" value="Data Final" />
                            <x-text-input id="data_final" class="block mt-1 w-full" type="date" name="data_final"
                                :value="old('data_final', $programacao->data_final->format('Y-m-d'))" required />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" value="Status" />
                            <select name="status" id="status"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1" @selected(old('status', $programacao->status))>Ativa</option>
                                <option value="0" @selected(old('status', $programacao->status) == 0)>Inativa</option>
                            </select>
                        </div>

                        <!-- SEÇÃO DE TELAS -->
                        <div class="mt-6">
                            <x-input-label value="Exibir nesta(s) Tela(s)" />
                            <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach ($telas as $tela)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="telas[]" value="{{ $tela->id }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            @if($programacao->telas->contains($tela->id)) checked @endif>
                                        <span class="ml-2 text-sm text-gray-600">{{ $tela->nome }}
                                            ({{ $tela->localizacao }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                Atualizar
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Nova Programação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('programacoes.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="titulo" value="Título" />
                            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
                                :value="old('titulo')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="data_inicio" value="Data de Início" />
                            <x-text-input id="data_inicio" class="block mt-1 w-full" type="date" name="data_inicio"
                                :value="old('data_inicio')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="data_final" value="Data Final" />
                            <x-text-input id="data_final" class="block mt-1 w-full" type="date" name="data_final"
                                :value="old('data_final')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" value="Status" />
                            <select name="status" id="status"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1">Ativa</option>
                                <option value="0">Inativa</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                Cadastrar
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
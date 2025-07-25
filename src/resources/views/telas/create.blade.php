<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Nova Tela') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('telas.store') }}">
                        @csrf

                        <div>
                            <label for="nome" class="block font-medium text-sm text-gray-700">Nome</label>
                            <input id="nome" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text"
                                name="nome" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="localizacao" class="block font-medium text-sm text-gray-700">Localização</label>
                            <input id="localizacao" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                type="text" name="localizacao" required />
                        </div>

                        <div class="mt-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                                <option value="1">Ativa</option>
                                <option value="0">Inativa</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Cadastrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    {{-- O Cabeçalho da Página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciamento de Telas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensagem de Sucesso --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Botão para Cadastrar Nova Tela --}}
                    <div class="mb-4">
                        <a href="{{ route('telas.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Cadastrar Nova Tela
                        </a>
                    </div>

                    {{-- Tabela para Listar as Telas --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Localização</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Loop para exibir cada tela cadastrada --}}
                            @forelse ($telas as $tela)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tela->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $tela->localizacao }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($tela->status)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ativa</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inativa</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('telas.edit', $tela) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                        <form action="{{ route('telas.destroy', $tela) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta tela?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 ml-4">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                {{-- Mensagem para quando não houver telas cadastradas --}}
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        Nenhuma tela cadastrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Links de Paginação --}}
                    <div class="mt-4">
                        {{ $telas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuário: ') }} {{ $usuario->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong>Atenção!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mt-4">
                            <label for="nome" class="block font-medium text-sm text-gray-700">Nome</label>
                            <input id="nome" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="text"
                                name="nome" value="{{ old('nome', $usuario->nome) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="matricula" class="block font-medium text-sm text-gray-700">Matrícula</label>
                            <input id="matricula" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                type="text" name="matricula" value="{{ old('matricula', $usuario->matricula) }}"
                                required />
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                type="email" name="email" value="{{ old('email', $usuario->email) }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="senha" class="block font-medium text-sm text-gray-700">Nova Senha (deixe em
                                branco para não alterar)</label>
                            <input id="senha" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                type="password" name="senha" autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <label for="senha_confirmation" class="block font-medium text-sm text-gray-700">Confirmar
                                Nova Senha</label>
                            <input id="senha_confirmation"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300" type="password"
                                name="senha_confirmation" />
                        </div>

                        <div class="mt-4">
                            <label for="role" class="block font-medium text-sm text-gray-700">Função</label>
                            <select name="role" id="role" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                required>
                                <option value="user" @if($usuario->role == 'user') selected @endif>Usuário</option>
                                <option value="admin" @if($usuario->role == 'admin') selected @endif>Administrador
                                </option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Atualizar Usuário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
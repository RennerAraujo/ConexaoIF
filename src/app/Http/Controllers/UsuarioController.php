<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'matricula' => ['required', 'string', 'max:255', 'unique:usuarios'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'senha' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'],
        ]);

        Usuario::create([
            'nome' => $request->nome,
            'matricula' => $request->matricula,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        // Geralmente não é necessário para gerenciamento, mas pode ser implementado
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'matricula' => ['required', 'string', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'senha' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'],
        ]);

        $data = $request->only('nome', 'matricula', 'email', 'role');

        if ($request->filled('senha')) {
            $data['senha'] = Hash::make($request->senha);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $admin = Usuario::where('role', 'admin')->first();
        if (!$admin) {
            return back()->with('error', 'Nenhum administrador encontrado para transferir as programações.');
        }
        if ($usuario->id === $admin->id) {
            return back()->with('error', 'Não é possível excluir o administrador principal.');
        }
        $usuario->programacoes()->update(['usuario_id' => $admin->id]);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário excluído com sucesso! As programações foram transferidas para o administrador.');
    }
}
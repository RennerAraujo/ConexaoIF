<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'matricula' => ['required', 'string', 'max:255', 'unique:' . Usuario::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Usuario::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Usuario::create([
            'nome' => $request->name,
            'matricula' => $request->matricula,
            'email' => $request->email,
            'senha' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
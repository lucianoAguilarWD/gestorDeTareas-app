<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        //validación de login        
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //Si los datos son correctos
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); //prepara la sesión
            return redirect()->route('tasks.index')->with('message', 'Login exitoso'); //redirecciona a la página principal
        }

        //Si la contraseña no es correcta, regresa al login con un mensaje de error
        return redirect()->back()->with('message', 'Contraseña incorrecta')->withInput();
    }

    public function register(Request $request)
    {
        //Validación de datos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->whereNull('deleted_at'),
            ],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->withErrors(['email' => 'El email ya está en uso.']);
        }
        
        // Si no existe, crea el usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
    
        //Autentica al usuario y redirecciona a la página principal
        Auth::login($user);
        return redirect()->route('tasks.index')->with('message', 'Login exitoso');
    }

    public function logout(Request $request)
    {
        //Finaliza la sesión y redirecciona al login
        Auth::logout();

        //Invalida la sesión y genera un nuevo token de sesión para prevenir ataques de cookie theft
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //Redirecciona al login con un mensaje de despedida
        return redirect()->route('login')->with('message', 'Sesión finalizada');
    }
}

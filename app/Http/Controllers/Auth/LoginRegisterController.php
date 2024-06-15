<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelicula;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class LoginRegisterController extends Controller
{
    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('verification.notice');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Establecer una variable de sesión para mostrar la alerta solo una vez
            $request->session()->flash('showLoginAlert', true);
    
            return redirect()->route('home');
        }
    
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }
    

    /**
     * Display a home to authenticated & verified users.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $orderField = $request->input('orderField', 'puntuacion_media_asc');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');
        $login=true;
        switch ($orderField) {
            case 'titulo_desc':
                $orderField = 'titulo';
                $order = 'desc';
                break;
            case 'titulo_asc':
                $orderField = 'titulo';
                $order = 'asc';
                break;
            case 'puntuacion_media_desc':
                $orderField = 'puntuacion_media';
                $order = 'desc';
                break;
            case 'puntuacion_media_asc':
                $orderField = 'puntuacion_media';
                $order = 'asc';
                break;
            case 'ano_lanzamiento_desc':
                $orderField = 'ano_lanzamiento';
                $order = 'desc';
                break;
            case 'ano_lanzamiento_asc':
                $orderField = 'ano_lanzamiento';
                $order = 'asc';
                break;
        }

        $query = Pelicula::orderBy($orderField, $order);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('titulo', 'LIKE', "%{$search}%")
                    ->orWhere('ano_lanzamiento', 'LIKE', "%{$search}%");
            });
        }

        $peliculas = $query->paginate($perPage)->withQueryString();

        return view('peliculas.index')->with([
            'peliculas' => $peliculas,
            'perPage' => $perPage,
            'order' => $order,
            'orderField' => $request->input('orderField'),
            'search' => $search, 
            'login' =>  $login
        ]);
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}

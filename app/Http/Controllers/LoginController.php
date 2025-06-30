<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function acceso(Request $request)
    {
        $credentials =  request()->only('username', 'password');

        if(Auth::attempt($credentials))
        {
            session(['estatus' => auth()->user()->estatus_id]);
            session(['nivel' => auth()->user()->nivel_id]);

            request()->session()->regenerate(); 

            if(session('estatus') == 2)
            {
                return back()->withErrors([
                    'message'=>'Usuario suspendido'
                ]);    
            }
            else
            {
                if(session('nivel') == 1)
                {
                    return redirect()->route('dashboard');
                }
                else
                {
                    if(session('nivel') == 2)
                    {
                        return redirect()->route('dashboard-recopilador');
                    }
                    else
                    {
                        return back()->withErrors([
                            'message'=>'Nivel no autorizado'
                        ]);
                    }
                }
            }
        }
        else
        {
            return back()->withErrors([
                'message'=>'Credenciales incorrectas'
            ]);
        }
    }
}

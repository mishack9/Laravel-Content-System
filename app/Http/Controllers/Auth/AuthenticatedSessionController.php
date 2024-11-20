<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if(Auth::attempt($request->only('email', 'password'))){
        
        $request->session()->regenerate();
        $role = Auth::user()->role;

        switch($role){
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'editor':
                return redirect()->route('admin.createPost');
            case 'user':
                return redirect()->route('viewer.dashboard');
            default:
                return redirect()->route('home');
        }

      }

          return redirect()->route('login')->with('error', 'The Provided Credentails Does Match Our Record !!!!');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

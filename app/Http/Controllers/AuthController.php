<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = Str::lower($request->input('email'));
        $key = $email . '|' . $request->ip();
        $maxAttempts = 5;
        $decayMinutes = 15;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['email' => "Too many login attempts. Try again in {$seconds} seconds."])->onlyInput('email');
        }

        $user = User::where('email', $email)->first();
        if ($user && $user->lockout_until && Carbon::now()->lt(Carbon::parse($user->lockout_until))) {
            $until = Carbon::parse($user->lockout_until)->diffForHumans();
            return back()->withErrors(['email' => "Account locked. Try again {$until}."])->onlyInput('email');
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            // Increment rate limiter
            RateLimiter::hit($key, $decayMinutes * 60);

            // Increment failed attempts on user record if exists
            if ($user) {
                $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;
                if ($user->failed_login_attempts >= $maxAttempts) {
                    $user->lockout_until = Carbon::now()->addMinutes($decayMinutes);
                }
                $user->save();
            }

            return back()->withErrors(['email' => 'Email au password si sahihi.'])->onlyInput('email');
        }

        // Successful login: clear rate limiter and reset counters
        RateLimiter::clear($key);
        if ($user) {
            $user->failed_login_attempts = 0;
            $user->lockout_until = null;
            $user->last_login_at = Carbon::now();
            $user->save();
        }

        $request->session()->regenerate();

        return Auth::user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

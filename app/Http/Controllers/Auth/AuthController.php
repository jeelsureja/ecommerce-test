<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        try {
            return view('auth.login');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'somthing went wrong']);
        }
    }

    public function verifyLogin(AuthRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            // dd($credentials);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user) {
                    return redirect()->route('home')->with('success', 'Login successfully');
                } else {
                    return redirect()->back()->with(['error' => 'User not found']);
                }
            } else {
                return redirect()->back()->with(['error' => 'Invalid credentials']);
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'somthing went wrong']);
        }
    }

    public function register()
    {
        try {
            return view('auth.register');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => 'somthing went wrong']);
        }
    }

    public function userRegister(AuthRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Register successfully');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            session()->flush();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Logout successfully');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}

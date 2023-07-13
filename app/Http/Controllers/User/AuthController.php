<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login()
  {
    return inertia('User/Login');
  }

  public function doLogin(Request $request)
  {
    $credentials =  $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
      $user = Auth::user();

      $user->tokens()->delete();
      $user->createToken('web-token')->plainTextToken;

      return  to_route('homepage');
    }
    return throw ValidationException::withMessages(
      [
        'message' => 'Wrong email or password'
      ]
    );
  }

  public function logout(Request $request)
  {
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return to_route('user-login');
  }

  public function register()
  {
    return inertia('User/Register');
  }

  public function doRegister(Request $request)
  {
    $request->validate([
      'name' => 'required|max:20',
      'email' => 'required|email',
      'password' => 'required|min:8'
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    return to_route('homepage');
  }
}

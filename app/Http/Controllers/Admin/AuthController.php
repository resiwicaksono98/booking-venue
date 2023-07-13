<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function login()
  {
    return inertia('Admin/Login');
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

      return  redirect('/admin');
    }
    return throw ValidationException::withMessages(
      [
        'message' => 'Wrong email or password'
      ]
    );
  }

  public function doLogout(Request $request)
  {
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/admin/login');
  }
}

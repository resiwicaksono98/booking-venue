<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    $user_id = Auth::user()->id;
    $transactions = Transaction::with([ 'users', 'proofPayment', 'venue'])->where('user_id', $user_id)->get();
    return inertia('User/Dashboard',[
      'transactions' => $transactions
    ]);
  }
}

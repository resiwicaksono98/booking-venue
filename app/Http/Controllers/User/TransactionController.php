<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Venue;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ProofPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

  public function order(Request $request, $slug)
  {
    $request->validate([
      'order_date' => 'required|date',
      'start_time' =>  'required',
      'total_guest' => 'required'
    ]);

    $venue = Venue::where('slug', $slug)->first();

    $transaction = Transaction::create([
      'user_id' => $request->user_id,
      'venue_id' => $venue->id,
      'id_transaction' => 'transaction' . '-' . Carbon::today()->toDateString()  . '-' . Str::random(8),
      'order_date' => $request->order_date,
      'start_time' => $request->start_time,
      'total_guest' => $request->total_guest
    ]);

    return to_route('user-payment', $transaction->id_transaction);
  }

  public function payment($id_transaction)
  {
    $payment = Transaction::with(['users', 'venue'])
      ->where('id_transaction', $id_transaction)
      ->first();
      $proofPayment = ProofPayment::where('transaction_id', $payment->id)->get();;
    return inertia('User/Payment', [
      'payment' => $payment,
      'proofPayment' => $proofPayment
    ]);
  }

  public function doPayment(Request $request, $id_transaction)
  {
    $request->validate([
      'type' => 'required',
      'bank' => 'required',
      'account_number' => 'required|numeric',
      'name' => 'required|max:15',
      'phone_number' => 'required|numeric'
    ]);

    $transaction = Transaction::where('id_transaction', $id_transaction)->first();

    if ($request->file('image')) {
      // Handle Image
      $image = $request->file('image');
      $imageName = 'proof-images' . '-' . time() . '.' . $image->extension();
      $image->move(public_path('/storage/proof-images'), $imageName);

      ProofPayment::create([
        'transaction_id' => $transaction->id,
        'type' => $request->type,
        'bank' => $request->bank,
        'account_number' => $request->account_number,
        'name' => $request->name,
        'phone_number' => $request->phone_number,
        'image' => $imageName
      ]);
    } else {

      ProofPayment::create([
        'transaction_id' => $transaction->id,
        'type' => $request->type,
        'bank' => $request->bank,
        'account_number' => $request->account_number,
        'name' => $request->name,
        'phone_number' => $request->phone_number,

      ]);
    }


    return to_route('user-dashboard');
  }

  public function detail($id_transaction)
  {
    $transaction = Transaction::with(['users', 'venue'])->where('id_transaction', $id_transaction)->first();
    $proofPayment = ProofPayment::where('transaction_id', $transaction->id)->get();;
    return inertia('User/DetailOrder', [
      'transaction' => $transaction,
      'proofPayment' => $proofPayment
    ]);
  }
}

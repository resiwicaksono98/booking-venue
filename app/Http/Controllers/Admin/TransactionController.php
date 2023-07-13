<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ProofPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Support\Facades\Date;

class TransactionController extends Controller
{
    public function index()
    {
      $transactions = Transaction::with('users')->latest()->get();

      return inertia('Admin/Transaction/Index', [
        'transactions' => $transactions
      ]);
    }

    public function create()
    {
      $users = User::get();
      $venues = Venue::get();
      return inertia('Admin/Transaction/Create', [
        'users' => $users,
        'venues' => $venues
      ]);
    }

    public function store(Request $request)
    {
      $request->validate([
        'user_id' => 'required',
        'venue_id' => 'required',
        'order_date' => 'required',
        'start_time' => 'required',
        'total_guest' => 'required',
        'payment_status' => 'required'
      ]);

      $transaction = Transaction::create([
        'user_id' => $request->user_id,
        'venue_id' => $request->venue_id,
        'order_date' => $request->order_date,
        'id_transaction' => 'transaction'. '-' . Carbon::today()->toDateString()  . '-'. Str::random(8),
        'start_time' => $request->start_time,
        'total_guest' => $request->total_guest,
        'payment_status' => $request->payment_status
      ]);

      if($transaction){
        ProofPayment::create([
          'transaction_id' => $transaction->id,
        ]);
      }

      return to_route('transaction-index');
    }

    public function detail($id_transaction)
    {
      $transaction = Transaction::with(['users'])->where('id_transaction', $id_transaction)->first();

      return inertia('Admin/Transaction/Detail', [
        'transaction' =>  $transaction,
      ]);
    }

    public function edit($id_transaction)
    {
      $users = User::get();
      $venues = Venue::get();
      $transaction = Transaction::with(['users'])->where('id_transaction', $id_transaction)->first();
      return inertia('Admin/Transaction/Edit',[
        'users' => $users,
        'transaction' => $transaction,
        'venues' => $venues
      ]);
    }

    public function update(Request $request, $id_transaction)
    {
      $request->validate([
        'user_id' => 'required',
        'venue_id' => 'required',
        'order_date' => 'required',
        'start_time' => 'required',
        'total_guest' => 'required',
        'payment_status' => 'required'
      ]);

      $transaction = Transaction::where('id_transaction', $id_transaction)->first();
      $transaction->update([
        'user_id' => $request->user_id,
        'venue_id' => $request->venue_id,
        'order_date' => $request->order_date,
        'start_time' => $request->start_time,
        'total_guest' => $request->total_guest,
        'payment_status' => $request->payment_status
      ]);

      return to_route('transaction-index');
    }

    public function destroy($id_transaction)
    {
      $transaction = Transaction::where('id_transaction', $id_transaction)->first();
      $transaction->delete();

      return to_route('transaction-index');
    }

    public function proofPayment($id_transaction)
    {
      $proofPayment = ProofPayment::where('transaction_id' , $id_transaction)->get();
      return inertia('Admin/Transaction/ProofPayment', [
        'proofPayment' => $proofPayment
      ]);
    }

    public function updateStatusProofPayment(Request $request,$id_proofPayment)
    {
      $request->validate([
        'status' => 'required'
      ]);
      $proofPayment = ProofPayment::where('id', $id_proofPayment)->first() ;
      $proofPayment->update([
        'status' => $request->status
      ]);

      return to_route('proof-index',$proofPayment->transaction_id);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofPayment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','type', 'bank', 'account_number', 'name' , 'phone_number', 'image', 'status'];

    public function transaction()
    {
      return $this->belongsTo(Transaction::class, 'transaction_id');

    }

}

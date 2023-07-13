<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'venue_id' ,'id_transaction', 'order_date', 'start_time', 'total_guest', 'payment_status'];

    public function users()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function venue()
    {
      return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function proofPayment()
    {
      return $this->HasMany(ProofPayment::class, 'id');
    }
}

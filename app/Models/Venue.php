<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
      'name', 'price', 'image', 'address', 'description','max_capacity', 'slug'
  ];

  public function transactions()
  {
    $this->hasMany(Transaction::class, 'id');
  }
}

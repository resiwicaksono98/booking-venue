<?php

namespace App\Http\Controllers\User;

use App\Models\Venue;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProofPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class VenueController extends Controller
{
  public function index()
  {
    $venues = Venue::get();
    return inertia('User/Homepage', [
      'venues' => $venues
    ]);
  }

  public function detailVenue($slug)
  {
    $venue = Venue::where('slug', $slug)->first();
    return inertia('User/DetailVenue', [
      'venue' => $venue
    ]);
  }


}

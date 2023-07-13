<?php

namespace App\Http\Controllers\Admin;

use App\Models\Venue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;

class VenueController extends Controller
{
  public function index()
  {
    $venues = Venue::get();
    return inertia('Admin/Venue/Index',[
    'venues' => $venues
  ]);
  }

  public function create()
  {
    return inertia('Admin/Venue/Create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'address' => 'required',
      'price' => 'required',
      'max_capacity' => 'required',
      'image' => 'required'
    ]);


    if ($request->file('image')) {
      // Handle Image
      $image = $request->file('image');
      $imageName = 'cover-venue' . '-' . time() . '.' . $image->extension();
      $image->move(public_path('/storage/cover-images'), $imageName);
    }

    Venue::create([
      'name' => $request->name,
      'slug' => Str::slug($request->name . '-' . Str::random(8)),
      'description' => $request->description,
      'address' => $request->address,
      'price' => $request->price,
      'max_capacity' => $request->max_capacity,
      'image' => $imageName
    ]);

    return  to_route('venue-index');
  }

  public function show ($slug)
  {
    $venue = Venue::where('slug', $slug)->first();
    return inertia('Admin/Venue/Detail' ,[
      'venue' => $venue
    ]);
  }

  public function edit($slug)
  {
    $venue = Venue::where('slug', $slug)->first();
    return inertia('Admin/Venue/Edit' ,[
      'venue' => $venue
    ]);
  }

  public function update(Request $request, $slug)
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'address' => 'required',
      'price' => 'required',
      'max_capacity' => 'required',
      'image' => 'required|max:2048'
    ]);

    $venue = Venue::where('slug', $slug)->first();

    // Handle Image
    $image = $request->file('image');
    $oldPicture = public_path('/storage/cover-images/' . $venue->image);

    if ($image) {
      $imageName = 'cover-images' . '-' . time() . '.' . $image->extension();
      $image->move(public_path('storage/cover-images'), $imageName);
      if (File::exists($oldPicture)) {
        unlink($oldPicture);
      }
      $venue->update([
        'image' => $imageName,
      ]);
    }

    // update
    $venue->update([
      'name' => $request->name,
      'slug' => Str::slug($request->name . '-' . Str::random(8)),
      'description' => $request->description,
      'address' => $request->address,
      'price' => $request->price,
      'max_capacity' => $request->max_capacity,
    ]);

    return to_route('venue-index');
  }

  public function destroy(Request $request)
  {
    $slug = $request->slug;
    $venue = Venue::where('slug', $slug)->first();

    $oldImage = public_path('/storage/cover-images/' . $venue->image);

    if (File::exists($oldImage)) {
      unlink($oldImage);
    }

    Venue::where('slug', $slug)->delete();
    return back();
  }
}

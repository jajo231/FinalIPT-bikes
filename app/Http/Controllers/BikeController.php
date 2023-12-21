<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Bike;
use App\Models\BikePurchase;
use App\Models\User;
use App\Notifications\MailNotif;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::all();
        return view('bikes.index', compact('bikes'));
    }

    public function create()
    {
        return view('bikes.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'model' => 'required|string',
        'make' => 'required|string',
        'year' => 'required|integer',
        'description' => 'required|string',
    ]);

    $bikeData = $request->all();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/bike_images');
        $image->move($destinationPath, $imageName);
        $bikeData['image'] = "/bike_images/" . $imageName;
    }

    $bike = Bike::create($bikeData);
    $user = auth()->user()->name;

    $log_entry = $user . " added a bike \"" . $bike->make . "\" with the ID #" . $bike->id;
    event(new UserLog($log_entry));

    return redirect()->route('bikes.index')->with('success', 'bike added successfully.');
}


    public function show(Bike $bike)
    {
        return view('bikes.show', compact('bike'));
    }

    public function edit(Bike $bike)
    {
        return view('bikes.edit', compact('bike'));
    }

    public function update(Request $request, Bike $bike)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'model' => 'required|string',
        'make' => 'required|string',
        'year' => 'required|integer',
        'description' => 'required|string',
    ]);

    $bikeData = $request->all();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/bike_images');
        $image->move($destinationPath, $imageName);
        $bikeData['image'] = "/bike_images/" . $imageName;
    } else {
        $bikeData['image'] = $bike->image;
    }

    $oldMake = $bike->make;
    $oldModel = $bike->model;
    $oldYear = $bike->year;
    // $oldDescription = $bike->description;

    $bike->update($bikeData);


    $newMake = $bike->make;
    $newModel = $bike->model;
    $newYear = $bike->year;
    // $newDescription = $bike->description;

    $user = auth()->user()->name;

    $log_entry = $user . " updated the bike from:
    Make: \"" . $oldMake . "\" to \"" . $newMake . "\",
    Model: \"" . $oldModel . "\" to \"" . $newModel . "\",
    Year: \"" . $oldYear . "\" to \"" . $newYear . "\",

    with the ID #" . $bike->id;

    event(new UserLog($log_entry));

        return redirect()->route('bikes.index')->with('success', 'Updated successfully.');
    }


    public function destroy(Bike $bike)
    {
        $bike->delete();
        $user = auth()->user()->name;

        $log_entry = $user . " removed a  courier \"" . $bike->model . "\" with the ID #" . $bike->id;
        event(new UserLog($log_entry));

        return redirect()->route('bikes.index')->with('error', 'leted successfully.');
    }

    public function buy(Request $request, Bike $bike)
    {
        $user = $request->user();

        if ($bike->stocks <= 0) {
            return redirect()->route('bikes.index')->with('error', 'Sorry, this bike is out of stock.');
        }

        $bike->decrement('stocks');

        $purchase = new BikePurchase();
        $purchase->user_id = $user->id;
        $purchase->bike_id = $bike->id;
        $purchase->purchase_date = now();
        $purchase->save();

        $mailNotif = [
            'body' => 'Purchase Confirmation',
            'enrollmentText' => 'Thank you for your purchase',
            'thankyou' => 'Thank you!',
            'bike' => $bike->make . ' ' . $bike->model . ' (' . $bike->year . ')',
            'purchaseDate' => now()->format('m/d/Y H:i:s'),
        ];

        $user->notify(new MailNotif($mailNotif));

        $bike->save();

        return redirect()->route('bikes.index')->with('success', 'Purchase successful and receipt sent to your email.');
    }
}

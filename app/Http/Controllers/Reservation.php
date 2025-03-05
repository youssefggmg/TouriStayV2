<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\announcmentModel;
use App\Models\Reservation as ReservationModel;
use Illuminate\Support\Facades\Auth;
use \Datetime;

class Reservation extends Controller
{
    public function makeReservation(Request $request)
    {
        $dates = $request->dates;

        // Extract the two dates
        list($startDate, $endDate) = explode(" to ", $dates);

        // Convert them to DateTime objects
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        // Calculate the difference
        $interval = $start->diff($end);
        $userID = Auth::user()->id;
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $announcement = announcmentModel::find($request->announcmentID);
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',  // Change this based on your needs
                        'product_data' => [
                            'name' => $announcement->title,  // Use the announcement title as the product name
                        ],
                        'unit_amount' => $announcement->price * 100,  // Convert price to cents
                    ],
                    'quantity' => $interval->days,
                ]
            ],
            "metadata",
            'mode' => 'payment',
            'success_url' => url("/tourist/home"),
            'cancel_url' => url("/tourist/home"),
        ]);
        ReservationModel::create([
            "startDate"=>$start,
            "endDate"=>$end,
            "totale"=>$announcement->price * $interval->days,
            "userID"=>$userID,
            "announcmentID"=>$request->announcmentID,
        ]);
        return redirect($checkoutSession->url);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\announcmentModel;
use App\Models\Reservation as ReservationModel;
use Illuminate\Support\Facades\Auth;
use \Datetime;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirmReservation;

class Reservation extends Controller
{
    public function makeReservation(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $dates = $request->dates;
        // Extract the two dates
        list($startDate, $endDate) = explode(" to ", $dates);
        // Convert them to DateTime objects
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        // Calculate the difference
        $interval = $start->diff($end);
        $userID = Auth::user()->id;
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
                'mode' => 'payment',
                'success_url' => url("/tourist/home"),
                'cancel_url' => url("/tourist/home"),
            ]);
        ReservationModel::create([
            "startDate"=>$startDate,
            "endDate"=>$endDate,
            "totale"=>$announcement->price * $interval->days,
            "user_id"=>$userID,
            "announce_id"=>$request->announcmentID,
        ]);
        $details = [
            "name"=>Auth::user()->name,
            "announcmentName"=>$announcement->title,
            "startDate"=>$startDate,
            "endDate"=>$endDate,
            "totale"=>$announcement->price * $interval->days,
        ];
        Mail::to(Auth::user()->email)->send(new confirmReservation($details));
        return redirect($checkoutSession->url);
    }
}

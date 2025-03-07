<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\announcmentModel;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class admin extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $announcments = announcmentModel::paginate(5);
        return view("admin.home", compact("user", "announcments"));
    }
    public function owners()
    {
        $owners = User::whereHas('announcements')
            ->withCount('announcements')
            ->get();

        return view('admin.owners', compact('owners'));
    }
    public function badUser($id)
    {
        $user = User::find($id);
        $user->status = "disactiv";
        $user->save();
        return redirect()->back();
    }
    public function reservations()
    {
        $user = Auth::user();
        $reservations = Reservation::with(["user", "announcement"])->get();
        return view("admin.reservations", compact("reservations","user"));
    }
}

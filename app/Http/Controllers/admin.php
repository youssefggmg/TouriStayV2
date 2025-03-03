<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\announcmentModel;
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
}

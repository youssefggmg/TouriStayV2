<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;

class owner extends Controller
{
    public function index(){
        $user = Auth::user();
        $ownerAnnouncmets = $user->announcements;
        return view('owner.home',compact("user" , "ownerAnnouncmets"));
    }
}

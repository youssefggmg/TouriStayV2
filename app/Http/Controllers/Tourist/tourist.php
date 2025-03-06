<?php

namespace App\Http\Controllers\Tourist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\announcmentModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class tourist extends Controller
{
    public function index($perpage = 4)
    {
        $user = Auth::user();
        $announcments = announcmentModel::paginate($perpage);
        return view("tourist.home", compact("announcments", "user"));
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        $search = $request->input("search");
        $search = $request->input('search');

        $query = announcmentModel::query();

        if (is_numeric($search)) {
            $query->where('price', $search);
        } elseif (strtotime($search)) {
            $query->where('disponibility', $search);
        } else {
            $query->where('city', 'ILIKE', "%$search%");
        }

        $announcments = $query->get();
        return view("tourist.search", compact("announcments", "user"));
    }
    public function profile()
    {
        $user = Auth::user();

        return view("tourist.profile", compact('user'));
    }
    public function editForm(Request $request)
    {
        $user = Auth::user();
        return view("tourist.editform", compact('user'));
    }
    public function updateUserInfo(Request $request)
    {
        // Validation rules (all fields optional)
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $request->user()->id,
            'current_password' => 'nullable|string|min:6',
            'new_password' => 'nullable|string|min:6|different:current_password',
            'confirm_password' => 'nullable|string|same:new_password',
        ]);

        $user = $request->user();

        // Update name if provided
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        // Update email if provided
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        // Handle password update only if current_password is provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return Redirect::back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            // Check if both new_password and confirm_password are filled and match
            if ($request->filled('new_password') && $request->filled('confirm_password')) {
                if ($request->new_password === $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                } else {
                    return Redirect::back()->withErrors(['confirm_password' => 'The new password and confirmation do not match.']);
                }
            }
        }

        // Save only if changes were made
        if ($user->isDirty()) {
            $user->save();
            return redirect("/tourist/editform");
        }

        return redirect("/tourist/editform");
    }
    public function likeAnnouncement($id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $announcement = announcmentModel::find($id);
        if (!$user->likedAnnouncements()->where('announcement', $id)->exists()) {
            $user->likedAnnouncements()->attach($id);
            return redirect()->back()->with('success', 'Announcement liked successfully.');
        }
        return redirect()->back()->with('error', 'You have already liked this announcement.');
    }
    public function myReservations(){
        $user = Auth::user();
        $reservations= Auth::user()->Reservations()->with("announcement")->get();
        return view("tourist.myreservation",compact("user","reservations"));
    }
}

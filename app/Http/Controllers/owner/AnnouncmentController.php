<?php
namespace App\Http\Controllers\owner;

use Illuminate\Http\Request;
use App\Models\announcmentModel;
use App\Models\EquipmetModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class AnnouncmentController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $equipments = EquipmetModel::all();
        return view('owner.createannoucment', compact("user", "equipments"));
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric',
            'disponibility' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'equipments' => 'array',
            'equipments.*' => 'exists:equipment,id' // Validate each equipment ID
        ]);

        // Create the announcement
        $announcement = announcmentModel::create([
            'title' => $validated['title'],
            'city' => $validated['city'],
            'price' => $validated['price'],
            'disponibility' => $validated['disponibility'],
            'user_id' => $validated['user_id']
        ]);

        if (!empty($validated['equipments'])) {
            $announcement->equipments()->attach($validated['equipments']);
        }

        return redirect()->back()->with('success', 'Announcement created successfully!');
    }
    public function edit($id)
    {
        $announcement = announcmentModel::find($id);
        // dd($announcement);
        $equipments = EquipmetModel::all();

        // Check if the logged-in user owns the announcement
        if (Auth::id() !== $announcement->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Access!');
        }
        $user = Auth::user();

        return view('owner.editannouncement', compact('announcement', 'equipments', 'user'));
    }
    public function update(Request $request, $id)
    {
        $announcement = announcmentModel::findOrFail($id);

        if (Auth::id() !== $announcement->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Access!');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric',
            'disponibility' => 'required|date',
            'equipments' => 'array',
            'equipments.*' => 'exists:equipment,id'
        ]);

        // Update announcement
        $announcement->update([
            'title' => $validated['title'],
            'city' => $validated['city'],
            'price' => $validated['price'],
            'disponibility' => $validated['disponibility']
        ]);

        // Sync the selected equipments
        if (!empty($validated['equipments'])) {
            $announcement->equipments()->sync($validated['equipments']);
        } else {
            $announcement->equipments()->detach(); // Remove all equipments if none selected
        }

        return redirect()->back()->with('success', 'Announcement updated successfully!');
    }
    public function delete($id)
    {
        $user = Auth::user();
        $announcement = announcmentModel::findOrFail($id);

        if ($announcement->user_id !== $user->id && $user->role != "admin") {
            return redirect()->back();
        }

        $announcement->delete(); // Soft delete

        return redirect()->back();
    }
    
    public function deletedAnnouncements()
    {
        $user = Auth::user();
        $deletedAnnouncements = announcmentModel::onlyTrashed()->with('owner')->get();;
        return view('admin.deleted', compact('deletedAnnouncements',"user"));
    }

}

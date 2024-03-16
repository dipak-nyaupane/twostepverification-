<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\backend\UserRole;
use App\Models\backend\Genders;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all users
        $allData = User::query();

        // Fetch user roles and genders
        $userRole = UserRole::all();
        $genders = Genders::all();

        // Filtering based on name
        if ($request->has('name')) {
            $name = $request->input('name');
            $allData->where('name', 'like', '%' . $name . '%');
        }

        // Filtering based on user role
        if ($request->has('user_role')) {
            $userRoleId = $request->input('user_role');
            $allData->where('user_role', $userRoleId);
        }

        // Get the filtered data
        $allData = $allData->get();

        // Check if data is fetched properly
        if (!$allData) {
            // Handle the case where no data is found
            // For example, return a message or redirect
            return redirect()->route('users')->with('error', 'No users found.');
        }

        // Return view with data
        return view('admin.backend.user.index', compact('allData', 'userRole', 'genders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.backend.user.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

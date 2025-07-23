<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::all();
            return response()->json($user);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch users.",
                $error
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'delivery_address' => 'required|string',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->delivery_address = $request->delivery_address;
            $user->password = Hash::make('Qwerty1.');
            $user->role = 2;
            $user->save();
            return response()->json($user);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a user.",
                $error
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch user.",
                $error
            ], 500);
        }
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'delivery_address' => 'required|string',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->delivery_address = $request->delivery_address;
            $user->password = Hash::make('Qwerty1.');
            $user->role = $request->role;
            $user->update();
            return response()->json($user);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a user.",
                $error
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json("User deleted successfully");
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to delete user.",
                $error
            ], 500);
        }
    }
}

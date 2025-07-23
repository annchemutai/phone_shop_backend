<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Roles::all();
            return response()->json($roles);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch roles.",
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
        ]);

        try {
            $role = new Roles();
            $role->name = $request->name;
            $role->save();
            return response()->json($role);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to create a role.",
                $error
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles, $id)
    {
        try {
            $role = Roles::findOrFail($id);
            return response()->json($role);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to fetch role.",
                $error
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $role = Roles::findOrFail($id);
            $role->name = $request->name;
            $role->save();
            return response()->json($role);
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to update a role.",
                $error
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles, $id)
    {
        try {
            $role = Roles::findOrFail($id);
            $role->delete();
            return response()->json('Role deleted successfully');
        } catch (\Exception $error) {
            return response()->json([
                "Error" => "Failed to delete a role.",
                $error
            ], 500);
        }
    }
}

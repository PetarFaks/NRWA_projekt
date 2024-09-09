<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        return response()->json($user);
    }

    public function getAddress()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $address = Address::find($user->AddressID);

        if (!$address) {
            return response()->json(['message' => 'No address found for the user'], 404);
        }

        return response()->json($address);
    }
    public function getUserDetails()
{
    $user = Auth::user();
    return response()->json($user);
}



public function getUserAddress()
{
    
    $user = Auth::user();

    
    if (!$user->AddressID) {
        return response()->json(['message' => 'No address associated with this user'], 404);
    }

    
    $address = Address::find($user->AddressID);

    
    if (!$address) {
        return response()->json(['message' => 'Address not found'], 404);
    }

    
    return response()->json($address);
}



public function updateDetails(Request $request)
    {
        $request->validate([
            'ContactNumber' => 'nullable|string|max:15',
        ]);

        $user = Auth::user();
        $user->ContactNumber = $request->input('ContactNumber');
        $user->save();

        return response()->json(['message' => 'User details updated successfully', 'user' => $user]);
    }


    public function admin_index()
    {
        $this->authorizeAdmin();
        return User::all();
    }

    public function admin_store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'CustomerName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'ContactNumber' => 'nullable|string|max:15',
            'role' => 'required|string|max:255',
        ]);

        $user = User::create([
            'CustomerName' => $request->CustomerName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ContactNumber' => $request->ContactNumber,
            'role' => $request->role ?? 'user',
        ]);
        return response()->json($user, 201);
    }

    public function admin_show(User $user)
    {
        $this->authorizeAdmin();
        return $user;
    }

    public function admin_update(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $request->validate([
            'CustomerName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'ContactNumber' => 'nullable|string|max:15',
            'role' => 'required|string|max:255',
        ]);

        $user->update([
            'CustomerName' => $request->CustomerName,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'ContactNumber' => $request->ContactNumber,
            'role' => $request->role ?? $user->role,
        ]);

        return response()->json($user);
    }

    public function admin_destroy(User $user)
    {
        $this->authorizeAdmin();

        $user->delete();
        return response()->json(null, 204);
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    public function admin_count()
    {
        try {
            $userCount = User::count();
            return response()->json(['count' => $userCount]);
        } catch (\Exception $e) {
            Log::error('Error counting users: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while counting users'], 500);
        }
    }

}

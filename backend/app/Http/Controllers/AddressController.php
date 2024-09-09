<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json($address);
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'AddressLine1' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'PostalCode' => 'required|string|max:20',
            
        ]);

        $address = Address::create([
            'AddressLine1' => $request->AddressLine1,
            'City' => $request->City,
            'PostalCode' => $request->PostalCode,
            
        ]);

       
        if (!Auth::check()) {
            Log::error('User not authenticated');
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $user = Auth::user();

        if (!$user) {
            Log::error('Authenticated user not found');
            return response()->json(['message' => 'Authenticated user not found'], 404);
        }

        try {
            $user->AddressID = $address->AddressID;
            $user->save();
            Log::info('User address updated successfully', ['user_id' => $user->id, 'address_id' => $address->AddressID]);
        } catch (\Exception $e) {
            Log::error('Error updating user address', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating user address'], 500);
        }

        return response()->json($address, 201);
    }

    


    public function update(Request $request, $id)
    {
        $request->validate([
            'AddressLine1' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'PostalCode' => 'required|string|max:20',
           
        ]);

        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->update($request->all());

        return response()->json($address);
    }

    public function admin_index()
    {
        $this->authorizeAdmin();
        return Address::all();
    }

    public function admin_store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'AddressLine1' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'PostalCode' => 'required|string|max:20',
        ]);

        $address = Address::create($request->all());
        return response()->json($address, 201);
    }

    public function admin_show(Address $address)
    {
        $this->authorizeAdmin();
        return $address;
    }

    public function admin_update(Request $request, Address $address)
    {
        $this->authorizeAdmin();

        $request->validate([
            'AddressLine1' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'PostalCode' => 'required|string|max:10',
           
        ]);

        $address->update($request->all());
        return response()->json($address);
    }

    public function admin_destroy(Address $address)
    {
        $this->authorizeAdmin();

        $address->delete();
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
    $count = Address::count();
    return response()->json(['count' => $count]);
}

}

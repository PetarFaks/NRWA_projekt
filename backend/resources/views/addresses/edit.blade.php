@extends('layouts.app')

@section('content')
    <h1>Edit Address</h1>
    <form method="POST" action="{{ route('addresses.update', $address->AddressID) }}">
        @csrf
        @method('PUT')
        <label for="AddressLine1">Address Line 1:</label>
        <input type="text" name="AddressLine1" id="AddressLine1" value="{{ $address->AddressLine1 }}" required>
        
        <label for="AddressLine2">Address Line 2:</label>
        <input type="text" name="AddressLine2" id="AddressLine2" value="{{ $address->AddressLine2 }}">
        
        <label for="City">City:</label>
        <input type="text" name="City" id="City" value="{{ $address->City }}" required>
        
        <label for="StateProvinceID">State/Province ID:</label>
        <input type="number" name="StateProvinceID" id="StateProvinceID" value="{{ $address->StateProvinceID }}" required>
        
        <label for="PostalCode">Postal Code:</label>
        <input type="text" name="PostalCode" id="PostalCode" value="{{ $address->PostalCode }}" required>
        
        <button type="submit">Update</button>
    </form>
@endsection

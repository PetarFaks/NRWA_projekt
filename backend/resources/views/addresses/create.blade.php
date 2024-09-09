@extends('layouts.app')

@section('content')
    <h1>Create Address</h1>
    <form method="POST" action="{{ route('addresses.store') }}">
        @csrf
        <label for="AddressLine1">Address Line 1:</label>
        <input type="text" name="AddressLine1" id="AddressLine1" required>
        
        <label for="AddressLine2">Address Line 2:</label>
        <input type="text" name="AddressLine2" id="AddressLine2">
        
        <label for="City">City:</label>
        <input type="text" name="City" id="City" required>
        
        <label for="StateProvinceID">State/Province ID:</label>
        <input type="number" name="StateProvinceID" id="StateProvinceID" required>
        
        <label for="PostalCode">Postal Code:</label>
        <input type="text" name="PostalCode" id="PostalCode" required>
        
        <button type="submit">Create</button>
    </form>
@endsection

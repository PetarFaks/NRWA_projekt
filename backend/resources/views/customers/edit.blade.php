@extends('layouts.app')

@section('content')
    <h1>Edit Customer</h1>
    <form method="POST" action="{{ route('customers.update', $customer->CustomerID) }}">
        @csrf
        @method('PUT')
        <label for="CustomerName">Customer Name:</label>
        <input type="text" name="CustomerName" id="CustomerName" value="{{ $customer->CustomerName }}" required>
        
        <label for="ContactNumber">Contact Number:</label>
        <input type="text" name="ContactNumber" id="ContactNumber" value="{{ $customer->ContactNumber }}">
        
        <label for="AddressID">Address ID:</label>
        <input type="number" name="AddressID" id="AddressID" value="{{ $customer->AddressID }}" required>
        
        <button type="submit">Update</button>
    </form>
@endsection

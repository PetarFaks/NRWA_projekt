@extends('layouts.app')

@section('content')
    <h1>Create Customer</h1>
    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        <label for="CustomerName">Customer Name:</label>
        <input type="text" name="CustomerName" id="CustomerName" required>
        
        <label for="ContactNumber">Contact Number:</label>
        <input type="text" name="ContactNumber" id="ContactNumber">
        
        <label for="AddressID">Address ID:</label>
        <input type="number" name="AddressID" id="AddressID" required>
        
        <button type="submit">Create</button>
    </form>
@endsection

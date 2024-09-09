@extends('layouts.app')

@section('content')
    <h1>Customer Details</h1>
    <p>Name: {{ $customer->CustomerName }}</p>
    <p>Contact: {{ $customer->ContactNumber }}</p>
    <p>Address ID: {{ $customer->AddressID }}</p>
    <a href="{{ route('customers.edit', $customer->CustomerID) }}">Edit</a>
    <form method="POST" action="{{ route('customers.destroy', $customer->CustomerID) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection

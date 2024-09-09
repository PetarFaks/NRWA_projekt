@extends('layouts.app')

@section('content')
    <h1>Create Sales Order</h1>
    <form method="POST" action="{{ route('sales_orders.store') }}">
        @csrf
        <label for="OrderDate">Order Date:</label>
        <input type="date" name="OrderDate" id="OrderDate" required>
        
        <label for="CustomerID">Customer:</label>
        <select name="CustomerID" id="CustomerID" required>
            @foreach ($customers as $customer)
                <option value="{{ $customer->CustomerID }}">{{ $customer->CustomerName }}</option>
            @endforeach
        </select>
        
        <button type="submit">Create</button>
    </form>
@endsection

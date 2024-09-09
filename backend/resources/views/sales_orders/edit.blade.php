@extends('layouts.app')

@section('content')
    <h1>Edit Sales Order</h1>
    <form method="POST" action="{{ route('sales_orders.update', $salesOrder->SalesOrderID) }}">
        @csrf
        @method('PUT')
        <label for="OrderDate">Order Date:</label>
        <input type="date" name="OrderDate" id="OrderDate" value="{{ $salesOrder->OrderDate }}" required>
        
        <label for="CustomerID">Customer:</label>
        <select name="CustomerID" id="CustomerID" required>
            @foreach ($customers as $customer)
                <option value="{{ $customer->CustomerID }}" {{ $customer->CustomerID == $salesOrder->CustomerID ? 'selected' : '' }}>
                    {{ $customer->CustomerName }}
                </option>
            @endforeach
        </select>
        
        <button type="submit">Update</button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Sales Order Details</h1>
    <p>Order Date: {{ $salesOrder->OrderDate }}</p>
    <p>Customer: {{ $salesOrder->customer->CustomerName }}</p>
    <a href="{{ route('sales_orders.edit', $salesOrder->SalesOrderID) }}">Edit</a>
    <form method="POST" action="{{ route('sales_orders.destroy', $salesOrder->SalesOrderID) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection

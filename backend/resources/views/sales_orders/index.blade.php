@extends('layouts.app')

@section('content')
    <h1>Sales Orders</h1>
    <a href="{{ route('sales_orders.create') }}">Create Sales Order</a>
    <ul>
        @foreach ($salesOrders as $salesOrder)
            <li>
                {{ $salesOrder->OrderDate }} - {{ $salesOrder->customer->CustomerName }} 
                <a href="{{ route('sales_orders.show', $salesOrder->SalesOrderID) }}">View</a>
                <a href="{{ route('sales_orders.edit', $salesOrder->SalesOrderID) }}">Edit</a>
                <form action="{{ route('sales_orders.destroy', $salesOrder->SalesOrderID) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

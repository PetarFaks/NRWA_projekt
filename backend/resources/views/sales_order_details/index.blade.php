@extends('layouts.app')

@section('content')
    <h1>Sales Order Details</h1>
    <a href="{{ route('sales_order_details.create') }}">Create Sales Order Detail</a>
    <ul>
        @foreach ($salesOrderDetails as $salesOrderDetail)
            <li>
                Order ID: {{ $salesOrderDetail->SalesOrderID }}, Product: {{ $salesOrderDetail->product->ProductName }}
                <a href="{{ route('sales_order_details.show', $salesOrderDetail->SalesOrderDetailID) }}">View</a>
                <a href="{{ route('sales_order_details.edit', $salesOrderDetail->SalesOrderDetailID) }}">Edit</a>
                <form action="{{ route('sales_order_details.destroy', $salesOrderDetail->SalesOrderDetailID) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

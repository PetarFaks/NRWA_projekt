@extends('layouts.app')

@section('content')
    <h1>Sales Order Detail</h1>
    <p>Sales Order ID: {{ $salesOrderDetail->SalesOrderID }}</p>
    <p>Product: {{ $salesOrderDetail->product->ProductName }}</p>
    <p>Order Quantity: {{ $salesOrderDetail->OrderQty }}</p>
    <p>Unit Price: {{ $salesOrderDetail->UnitPrice }}</p>
    <p>Unit Price Discount: {{ $salesOrderDetail->UnitPriceDiscount }}</p>
    <a href="{{ route('sales_order_details.edit', $salesOrderDetail->SalesOrderDetailID) }}">Edit</a>
    <form method="POST" action="{{ route('sales_order_details.destroy', $salesOrderDetail->SalesOrderDetailID) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection

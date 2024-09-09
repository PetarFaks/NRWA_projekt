@extends('layouts.app')

@section('content')
    <h1>Create Sales Order Detail</h1>
    <form method="POST" action="{{ route('sales_order_details.store') }}">
        @csrf
        <label for="SalesOrderID">Sales Order:</label>
        <select name="SalesOrderID" id="SalesOrderID" required>
            @foreach ($salesOrders as $salesOrder)
                <option value="{{ $salesOrder->SalesOrderID }}">{{ $salesOrder->SalesOrderID }}</option>
            @endforeach
        </select>
        
        <label for="ProductID">Product:</label>
        <select name="ProductID" id="ProductID" required>
            @foreach ($products as $product)
                <option value="{{ $product->ProductID }}">{{ $product->ProductName }}</option>
            @endforeach
        </select>
        
        <label for="OrderQty">Order Quantity:</label>
        <input type="number" name="OrderQty" id="OrderQty" required>
        
        <label for="UnitPrice">Unit Price:</label>
        <input type="number" step="0.01" name="UnitPrice" id="UnitPrice" required>
        
        <label for="UnitPriceDiscount">Unit Price Discount:</label>
        <input type="number" step="0.01" name="UnitPriceDiscount" id="UnitPriceDiscount">
        
        <button type="submit">Create</button>
    </form>
@endsection

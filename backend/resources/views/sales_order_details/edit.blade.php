@extends('layouts.app')

@section('content')
    <h1>Edit Sales Order Detail</h1>
    <form method="POST" action="{{ route('sales_order_details.update', $salesOrderDetail->SalesOrderDetailID) }}">
        @csrf
        @method('PUT')
        <label for="SalesOrderID">Sales Order:</label>
        <select name="SalesOrderID" id="SalesOrderID" required>
            @foreach ($salesOrders as $salesOrder)
                <option value="{{ $salesOrder->SalesOrderID }}" {{ $salesOrder->SalesOrderID == $salesOrderDetail->SalesOrderID ? 'selected' : '' }}>
                    {{ $salesOrder->SalesOrderID }}
                </option>
            @endforeach
        </select>
        
        <label for="ProductID">Product:</label>
        <select name="ProductID" id="ProductID" required>
            @foreach ($products as $product)
                <option value="{{ $product->ProductID }}" {{ $product->ProductID == $salesOrderDetail->ProductID ? 'selected' : '' }}>
                    {{ $product->ProductName }}
                </option>
            @endforeach
        </select>
        
        <label for="OrderQty">Order Quantity:</label>
        <input type="number" name="OrderQty" id="OrderQty" value="{{ $salesOrderDetail->OrderQty }}" required>
        
        <label for="UnitPrice">Unit Price:</label>
        <input type="number" step="0.01" name="UnitPrice" id="UnitPrice" value="{{ $salesOrderDetail->UnitPrice }}" required>
        
        <label for="UnitPriceDiscount">Unit Price Discount:</label>
        <input type="number" step="0.01" name="UnitPriceDiscount" id="UnitPriceDiscount" value="{{ $salesOrderDetail->UnitPriceDiscount }}">
        
        <button type="submit">Update</button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('products.update', $product->ProductID) }}">
        @csrf
        @method('PUT')
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" id="ProductName" value="{{ $product->ProductName }}" required>
        
        <label for="ProductNumber">Product Number:</label>
        <input type="text" name="ProductNumber" id="ProductNumber" value="{{ $product->ProductNumber }}" required>
        
        <label for="Color">Color:</label>
        <input type="text" name="Color" id="Color" value="{{ $product->Color }}">
        
        <label for="StandardCost">Standard Cost:</label>
        <input type="number" step="0.01" name="StandardCost" id="StandardCost" value="{{ $product->StandardCost }}" required>
        
        <label for="ListPrice">List Price:</label>
        <input type="number" step="0.01" name="ListPrice" id="ListPrice" value="{{ $product->ListPrice }}" required>
        
        <button type="submit">Update</button>
    </form>
@endsection

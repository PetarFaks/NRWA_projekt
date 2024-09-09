@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" id="ProductName" required>
        
        <label for="ProductNumber">Product Number:</label>
        <input type="text" name="ProductNumber" id="ProductNumber" required>
        
        <label for="Color">Color:</label>
        <input type="text" name="Color" id="Color">
        
        <label for="StandardCost">Standard Cost:</label>
        <input type="number" step="0.01" name="StandardCost" id="StandardCost" required>
        
        <label for="ListPrice">List Price:</label>
        <input type="number" step="0.01" name="ListPrice" id="ListPrice" required>
        
        <button type="submit">Create</button>
    </form>
@endsection

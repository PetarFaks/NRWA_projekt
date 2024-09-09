@extends('layouts.app')

@section('content')
    <h1>Product Details</h1>
    <p>Name: {{ $product->ProductName }}</p>
    <p>Number: {{ $product->ProductNumber }}</p>
    <p>Color: {{ $product->Color }}</p>
    <p>Standard Cost: {{ $product->StandardCost }}</p>
    <p>List Price: {{ $product->ListPrice }}</p>
    <a href="{{ route('products.edit', $product->ProductID) }}">Edit</a>
    <form method="POST" action="{{ route('products.destroy', $product->ProductID) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection

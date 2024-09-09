@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <a href="{{ route('products.create') }}">Create Product</a>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->ProductName }} - <a href="{{ route('products.show', $product->ProductID) }}">View</a></li>
        @endforeach
    </ul>
@endsection

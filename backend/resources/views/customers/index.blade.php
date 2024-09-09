@extends('layouts.app')

@section('content')
    <h1>Customers</h1>
    <a href="{{ route('customers.create') }}">Create Customer</a>
    <ul>
        @foreach ($customers as $customer)
            <li>
                {{ $customer->CustomerName }} 
                <a href="{{ route('customers.show', $customer->CustomerID) }}">View</a>
                <a href="{{ route('customers.edit', $customer->CustomerID) }}">Edit</a>
                <form action="{{ route('customers.destroy', $customer->CustomerID) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

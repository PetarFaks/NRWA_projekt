@extends('layouts.app')

@section('content')
    <h1>Addresses</h1>
    <a href="{{ route('addresses.create') }}">Create Address</a>
    <ul>
        @foreach ($addresses as $address)
            <li>
                {{ $address->AddressLine1 }}, {{ $address->City }} 
                <a href="{{ route('addresses.show', $address->AddressID) }}">View</a>
                <a href="{{ route('addresses.edit', $address->AddressID) }}">Edit</a>
                <form action="{{ route('addresses.destroy', $address->AddressID) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

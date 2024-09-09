@extends('layouts.app')

@section('content')
    <h1>Address Details</h1>
    <p>Address Line 1: {{ $address->AddressLine1 }}</p>
    <p>Address Line 2: {{ $address->AddressLine2 }}</p>
    <p>City: {{ $address->City }}</p>
    <p>State/Province ID: {{ $address->StateProvinceID }}</p>
    <p>Postal Code: {{ $address->PostalCode }}</p>
    <a href="{{ route('addresses.edit', $address->AddressID) }}">Edit</a>
    <form method="POST" action="{{ route('addresses.destroy', $address->AddressID) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection

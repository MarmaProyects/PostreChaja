<!-- resources/views/clients/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Client Details</h1>
    <p><strong>Fullname:</strong> {{ $client->fullname }}</p>
    <p><strong>Address:</strong> {{ $client->address }}</p>
    <p><strong>Phone:</strong> {{ $client->phone }}</p>
    <p><strong>Stars:</strong> {{ $client->stars }}</p>
    <p><strong>Notifications:</strong> {{ $client->notifications }}</p>
</div>
@endsection
<!-- resources/views/assistances/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asistencias</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-3">
        <form action="{{ route('assistances.check-in') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Check-in</button>
        </form>
    </div>

    <div class="mb-3">
        <form action="{{ route('assistances.check-out') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">Check-out</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Check-in</th>
                <th>Check-out</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assistances as $assistance)
                <tr>
                    <td>{{ $assistance->id }}</td>
                    <td>{{ $assistance->check_in }}</td>
                    <td>{{ $assistance->check_out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

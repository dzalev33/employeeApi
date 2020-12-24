@extends('layouts.app')

@section('content')
    <h1>employees</h1>

    @foreach($employees as $item)
        {{ $item->last_name  }}
    @endforeach

@endsection
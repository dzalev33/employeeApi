@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <a class="btn btn-dark" href="/">Back</a>
        <div class="row align-center">
            <h1>Employee List</h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">address</th>
                        <th scope="col">country</th>
                        <th scope="col">image</th>
                        <th scope="col">bio</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Employee ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $item)
                        <tr>
                            <td> {{ $item->title  }}</td>
                            <td> {{ $item->first_name  }}</td>
                            <td> {{ $item->last_name  }}</td>
                            <td> {{ $item->email  }}</td>
                            <td> {{ $item->date_of_birth  }}</td>
                            <td> {{ $item->address  }}</td>
                            <td> {{ $item->country  }}</td>
                            <td> {{ $item->image  }}</td>
                            <td> {{ $item->bio  }}</td>
                            <td> {{ $item->rating  }}</td>
                            <td> {{ $item->id  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
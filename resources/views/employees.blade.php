@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4"><h1>List of Employees</h1></div>
                    <hr>

                    <div class="panel-body">
                        @foreach($employees as $item)
                            <article>
                                <h4>
                                    {{ $item->title  }} {{ $item->first_name  }} {{ $item->last_name  }}
                                </h4>
                                <div class="body">
                                    <p><b>Email:</b> {{ $item->email  }}</p>
                                    <p> <b>Date of Birth:</b> {{ $item->date_of_birth  }}</p>
                                    <p> <b>Address: </b>{{ $item->address  }}</p>
                                    <p> <b>Country:</b> {{ $item->country  }}</p>
                                    <p> <b>Image Url:</b> {{ $item->image  }}</p>
                                    <p> <b>Bio:</b> {{ $item->bio  }}</p>
                                    <p> <b>Rating:</b> {{ $item->rating  }}</p>
                                    <p> <b>Id:</b> {{ $item->id }}</p>

                                </div>
                            </article>

                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
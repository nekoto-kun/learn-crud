@extends('layouts.master')

@section('title', $movie->title)

@section('content')
    <div class="col-md-12">
        <h2>{{ $movie->title }}</h2>
        <h5>
            <span class="badge badge-primary">
                <i class="fa fa-star fa-fw"></i>
                {{ $movie->rating }}
            </span>
        </h5>
        <p>
        <ul class="list-inline">
            <li class="list-inline-item">
                <i class="fa fa-th-large fa-fw"></i>
                <em>{{ $movie->genre }}</em>
            </li>
            <li class="list-inline-item">
                <i class="fa fa-calendar fa-fw"></i>
                {{ $movie->year }}
            </li>
        </ul>
        </p>
        <hr>
        <p class="lead">{{ $movie->description }}</p>
    </div>
@endsection

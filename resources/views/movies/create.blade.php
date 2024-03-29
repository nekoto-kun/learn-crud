@extends('layouts.master')

@section('title', 'Add New Movie')

@section('content')
    <h2>Add New Movie</h2>
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Genre</label>
                <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre"
                    id="genre" value="{{ old('genre') }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Year</label>
                <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year"
                    min="1900" max="2099" value="{{ old('year') }}">
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Rating</label>
                <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror"
                    name="rating" id="rating" min="1" max="5" value="{{ old('rating') }}">
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Add</button>
    </form>
@endsection

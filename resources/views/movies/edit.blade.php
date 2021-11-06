@extends('layout.master')
@section('title', 'Edit Movie')
@section('content')
    <h2>Update New Movie</h2>
    <form action="{{ route('movies.update', ['movie' => $movie->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') ?? $movie->title }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Genre</label>
                <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" id="genre"
                    value="{{ old('genre') ?? $movie->genre }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                rows="3">{{ old('description') ?? $movie->description }}
                             </textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Year</label>
                <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year"
                    min="1900" max="2099" value="{{ old('year') ?? $movie->year }}">
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Rating</label>
                <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" name="rating"
                    id="rating" min="1" max="10" value="{{ old('rating') ?? $movie->rating }}">
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="image-label">Image</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if ($movie->image)
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="filter-container p-0 row">
                            <div class="filtr-item col-sm-2">
                                <a href="{{ Storage::url($movie->image) }}" data-toggle="lightbox">
                                    <img src="{{ Storage::url($movie->image) }}" class="img-fluid mb-2" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
    </form>
@endsection

@push('js_after')
    <script>
        // Untuk upload file
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush

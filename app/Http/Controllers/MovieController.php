<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'genre' => 'required|max:100',
            'description' => 'max:65535',
            'year' => 'required|integer|min:1900|max:2099',
            'rating' => 'required|numeric|min:1|max:10',
            'image' => 'required|file|image|max:5000',
        ]);

        $movie = Movie::create($validateData);

        $fileExtension = $request->image->getClientOriginalExtension();
        $fileRename = "movieimg-" . time() . ".{$fileExtension}";
        $request->image->storeAs('public', $fileRename);

        $movie->image = $fileRename;
        $movie->save();

        $request->session()->flash('success', "Successfully adding {$validateData['title']}!");
        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'genre' => 'required|max:100',
            'description' => 'max:65535',
            'year' => 'required|integer|min:1900|max:2099',
            'rating' => 'required|numeric|min:1|max:10',
            'image' => 'required|file|mimes:pdf|max:5000',
        ]);

        if ($request->image) {
            // Hapus file yg sudah ada
            Storage::disk('public')->delete($movie->image);
        }

        $movie->update($validateData);

        $fileExtension = $request->image->getClientOriginalExtension();
        $fileRename = "movieimg-" . time() . ".{$fileExtension}";
        $request->image->storeAs('public', $fileRename);

        $movie->image = $fileRename;
        $movie->save();

        $request->session()
            ->flash('success', "Successfully updating {$validateData['title']}!");
        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        Storage::disk('public')->delete($movie->image);

        $movie->delete();
        return redirect()->route('movies.index')->with(
            'success',
            "Successfully deleting {$movie['title']}!"
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = 'Movies';
        return view('super_admin.movies.index', compact('user'));
    }

    public function dataTable()
    {
        return DataTables::of(Movie::all())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = 'Movies';
        return view('super_admin.movies.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'duration' => 'required|max:50',
            'director' => 'required|max:50',
            'movie_cast' => 'required|max:255',

        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')->with('message', 'Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);
        $user = 'Movies';

        return view('super_admin.movies.edit', compact('movie', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'duration' => 'required|max:50',
            'director' => 'required|max:50',
            'movie_cast' => 'required|max:255',
        ]);

        $movie = Movie::find($id);

        $movie->fill($request->all());

        if($movie->isDirty()){
            $movie->save();
            return redirect()->route('movies.index')->with('message','Data updated Successfully');
        }
        
        return redirect()->route('movies.index')->with('fail-message','Data not Updated');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Movie::find($id)->delete();
            return 'Movie has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;

class MovieController extends Controller
{
    public function __construct()
    {
        $title = "Movies";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.movies.index');
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
        return view('super_admin.movies.create');
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
            'release_at' => 'required',

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
        return view('super_admin.movies.edit', compact('movie'));
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
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:255',
            'duration' => 'required|max:50',
            'director' => 'required|max:50',
            'movie_cast' => 'required|max:255',
            'release_at' => 'required',
        ]);

        

        $movie = Movie::find($id);

        $movie->fill($validated);

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

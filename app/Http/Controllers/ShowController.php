<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Show;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{

    public function __construct()
    {
        $title = "Shows";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('operator.shows.index');
    }

    public function dataTable()
    {
        return Datatables::of(Auth::user()->operator->screens()->with('shows'))->make(true);
    }

    public function getScreen(Request $request)
    {
        $cinema_id = $request->post('cinema_id');
        $cinema = Auth::user()->operator->cinemas()->find($cinema_id);
        $data = Screen::where("cinema_id", $cinema->id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function getMovie(Request $request)
    {
        $movie_id = $request->post('movie_id');
        $data = Movie::find($movie_id);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
        $movies = Movie::pluck('name', 'id')->all();
        return view('operator.shows.create', compact('cinemas', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'screen_id' => 'required',
                'movie_id' => 'required',
                'price' => 'required',
                'start_at' => 'required',
                'end_at' => 'required',
            ],
            [
                'screen_id.required' => 'Screen must be selected.',
                'movie_id.required' => 'Movie must be selected.',
            ]
        );

        Show::create($validated);

        return redirect()->route('shows.index')->with('message', 'Data added Successfully');
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
        try {
           $show = Show::findOrFail($id);
            $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
            $movies = Movie::pluck('name', 'id')->all();
            $screen = Auth::user()->operator->screens();
            return view('operator.shows.edit', compact('screen', 'cinemas','movies','show'));
        } catch (Exception $e) {
            return redirect()->route('screens.index');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Show;
use Exception;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    public function index($id = 1)
    {
        return view('operator.shows.index');
    }

    public function dataTable()
    {
        $query = DB::table('shows')
            ->join('screens', 'shows.screen_id', '=', 'screens.id')
            ->join('cinemas', 'screens.cinema_id', '=', 'cinemas.id')
            ->join('movies', 'shows.movie_id', '=', 'movies.id')
            ->where('cinemas.operator_id', '=', Auth::user()->operator_id)
            ->select('cinemas.name as cinema_name', 'screens.name as screen_name', 'movies.name as movie_name', 'shows.price', 'shows.start_at', 'shows.end_at', 'shows.id');

        // $query = Show::withWhereHas('screen.cinema', function ($query) {
        //     $query->where('operator_id', Auth::user()->operator_id)->select('id','name');
        // })->with('movie:id,name');

        return Datatables::of($query)->make(true);
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

        $show = DB::table('shows')
        ->join('screens', 'shows.screen_id', '=', 'screens.id')
        ->join('cinemas', 'screens.cinema_id', '=', 'cinemas.id')
        ->join('movies', 'shows.movie_id', '=', 'movies.id')
        ->where('cinemas.operator_id', '=', Auth::user()->operator_id)
        ->pluck('shows.start_at')->toArray();

        foreach($show as $show_start_at){

            if($validated['start_at'] == $show_start_at){
                // dd('same data');
                return redirect()->back();
            }
        }
        // dd('not same data');
    
        Show::withWhereHas('screen.cinema')->create($validated);

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
            // $show = DB::table('shows')
            // ->join('screens', 'shows.screen_id', '=', 'screens.id')
            // ->join('cinemas', 'screens.cinema_id', '=', 'cinemas.id')
            // ->join('movies', 'shows.movie_id', '=', 'movies.id')
            // ->where('cinemas.operator_id', '=', Auth::user()->operator_id)
            // ->select('cinemas.name as cinema_name', 'screens.name as screen_name', 'movies.name as movie_name', 'shows.price', 'shows.start_at', 'shows.end_at', 'shows.id');
            
            $show = Show::withWhereHas('screen.cinema', function ($query) {
                $query->where('operator_id', Auth::user()->operator_id)->select('id', 'name');
            })->with('movie:id,name,duration,release_at')->findOrFail($id);
            
            $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
           
        
            $screens = Screen::pluck('name', 'id')->all();
            $movies = Movie::pluck('name', 'id')->all();


            // $movie = DB::table('shows')
            // ->join('movies', 'shows.movie_id', '=', 'movies.id')
            // ->where('shows.id', '=', '1')
            // ->select('movies.duration as movie_duration', 'movies.release_at', 'shows.id')->get();

            return view('operator.shows.edit', compact('cinemas', 'movies', 'screens', 'show'));
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
        $validated = $request->validate([
            'price' => 'required|max:4',
            'start_at' => 'required',
            'end_at' => '',
        ]);

        try {
            $shows = DB::table('shows')
            ->join('screens', 'shows.screen_id', '=', 'screens.id')
            ->join('cinemas', 'screens.cinema_id', '=', 'cinemas.id')
            ->join('movies', 'shows.movie_id', '=', 'movies.id')
            ->where('cinemas.operator_id', '=', Auth::user()->operator_id)
            ->pluck('shows.start_at')->toArray();
    
            foreach($shows as $show_start_at){
    
                if($validated['start_at'] == $show_start_at){
                    // dd('same data');
                    return redirect()->route('shows.edit', $id)->with('fail-message', 'Show available in same time.');
                }
            }

            $show = Show::withWhereHas('screen.cinema', function ($query) {
                $query->where('operator_id', Auth::user()->operator_id)->select('id', 'name');
            })->with('movie:id,name,duration,release_at')->findOrFail($id);

            $show->fill($validated);

            if ($show->isDirty()) {
                $show->save();
                return redirect()->route('shows.index')->with('message', 'Data updated Successfully');
            }

            return redirect()->route('shows.index')->with('fail-message', 'Data not Updated');
        } catch (Exception $e) {
            return redirect()->route('shows.index');
        }
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
            Show::find($id)->delete();
            return 'Show has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

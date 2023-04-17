<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{

    public function __construct()
    {
        $title = "Bookings";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.bookings.index');
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

    public function dataTable()
    {
        $query = DB::table('bookings')
            ->join('seats', 'seats.seat_id', '=', 'seat.id')
            ->join('screens', 'seats.screen_id', '=', 'screens.id')
            ->join('cinemas', 'screens.cinema_id', '=', 'cinemas.id')
            ->where('cinemas.operator_id', '=', Auth::user()->operator_id)
            ->select('cinemas.name as cinema_name', 'screens.name as screen_name', 'movies.name as movie_name', 'shows.price', 'shows.start_at', 'shows.end_at', 'shows.id');

        // $query = Show::withWhereHas('screen.cinema', function ($query) {
        //     $query->where('operator_id', Auth::user()->operator_id)->select('id','name');
        // })->with('movie:id,name');

        return Datatables::of($query)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
        $movies = Movie::pluck('name', 'id')->all();
        return view('operator.bookings.create', compact('cinemas', 'movies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

<?php

namespace App\Http\Controllers;

use App\Models\BookingRecords;
use App\Models\Bookings;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Seat;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class SeatController extends Controller
{

    public function __construct()
    {
        $title = "Bookings";
        View::share('title', $title);
    }

    public function dataTable()
    {
        $query = DB::table('bookings')
            ->join('cinemas', 'bookings.cinema_id', '=', 'cinemas.id')
            ->join('movies', 'bookings.movie_id', '=', 'movies.id')
            ->join('screens', 'bookings.screen_id', '=', 'screens.id')
            ->join('shows', 'bookings.show_id', '=', 'shows.id')
            ->where('cinemas.operator_id', '=', Auth::user()->operator_id)
            ->select('cinemas.name as cinema_name', 'screens.name as screen_name', 'movies.name as movie_name', 'shows.start_at as show_start_at', 'bookings.name as booking_name', 'amount', 'seat_array', 'bookings.id as booking_id');

        return Datatables::of($query)->make(true);
    }

    public function getShows(Request $request): \Illuminate\Http\JsonResponse
    {
        $screen_id = $request->post('screen_id');
        $screen = Auth::user()->operator->screens->find($screen_id);
        $movie_id = $request->post('movie_id');
        $movie = Movie::find($movie_id);
        $data = Show::where([["screen_id", $screen->id], ["movie_id", $movie->id]])
            ->get(["start_at", "end_at", "id", "price"]);
//        ['start_at', '>', Carbon::now()],
        return response()->json($data);
    }

    public function getSeats(Request $request)
    {
        $screen_id = $request->post('screen_id');
        $data = Screen::find($screen_id);
        return response()->json($data);
    }

    public function getScreen(Request $request)
    {
        $cinema_id = $request->post('cinema_id');
        $cinema = Auth::user()->operator->cinemas()->find($cinema_id);
        $data = Screen::where("cinema_id", $cinema->id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function getTickets(Request $request)
    {

        try {
            $name = $request->post('name');
            $amount = $request->post('amount');
            $cinema_id = $request->post('cinema_id');
            $screen_id = $request->post('screen_id');
            $movie_id = $request->post('movie_id');
            $show_id = $request->post('show_id');
            $seats = $request->post('seat_array');

            Bookings::create([
                'name' => $name,
                'amount' => $amount,
                'cinema_id' => $cinema_id,
                'show_id' => $show_id,
                'screen_id' => $screen_id,
                'movie_id' => $movie_id,
                'seat_array' => $seats,
            ]);

            $id = Bookings::select('id')->latest()->first();

            $query = DB::table('bookings')
                ->join('cinemas', 'bookings.cinema_id', '=', 'cinemas.id')
                ->join('movies', 'bookings.movie_id', '=', 'movies.id')
                ->join('screens', 'bookings.screen_id', '=', 'screens.id')
                ->join('shows', 'bookings.show_id', '=', 'shows.id')
                ->where('bookings.id', '=', $id['id'])
                ->select('cinemas.name as cinema_name', 'screens.name as screen_name', 'movies.name as movie_name', 'shows.start_at as show_start_at')->first();

            BookingRecords::create([
                'name' => $name,
                'amount' => $amount,
                'cinema' => $query->cinema_name,
                'show' => $query->show_start_at,
                'screen' => $query->screen_name,
                'movie' => $query->movie_name,
                'seat_array' => $seats,
            ]);
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }

    }

    public function getSelectedTickets(Request $request)
    {
        $screen_id = $request->post('screen_id');
        $show_id = $request->post('show_id');


        $data = Bookings::select(DB::raw('group_concat(seat_array)'))
            ->where([
                ['screen_id', $screen_id],
                ['show_id', $show_id],
            ])->get();

//        $seats_array = explode(",", $data);

        return response()->json($data);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
        $movies = Movie::pluck('name', 'id')->all();
        $ticketCount = array();
        for ($i = 1; $i <= 10; $i++) {
            array_push($ticketCount, $i);
        }

        return view('operator.bookings.create', compact('cinemas', 'movies', 'ticketCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Bookings::find($id)->delete();
            return 'Booking has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

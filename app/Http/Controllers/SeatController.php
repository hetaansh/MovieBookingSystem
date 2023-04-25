<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Movie;
use App\Models\Screen;
use App\Models\Seat;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SeatController extends Controller
{

    public function __construct()
    {
        $title = "Seats";
        View::share('title', $title);
    }

    public function getShows(Request $request): \Illuminate\Http\JsonResponse
    {
        $screen_id = $request->post('screen_id');
        $screen = Auth::user()->operator->screens->find($screen_id);
        $movie_id = $request->post('movie_id');
        $movie = Movie::find($movie_id);
        $data = Show::where([["screen_id", $screen->id], ["movie_id", $movie->id]])
            ->get(["start_at", "end_at", "id", "price"]);

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
        $name = $request->post('name');
        $amount = $request->post('amount');
        $cinema_id = $request->post('cinema_id');
        $screen_id = $request->post('screen_id');
        $movie_id = $request->post('movie_id');
        $show_id = $request->post('show_id');
        $seats = $request->post('seat_array');

//        $seats_array = explode(",", $seats);
//        $count = count($seats_array);
//
//        for ($i = 0; $i < $count; $i++) {
//            DB::table('seats')
//                ->where([
//                    ['screen_id', $screen_id],
//                    ['name', $seats_array[$i]],
//                ])->update([
//                    'selected' => 1
//                ]);
//        }

        Bookings::create([
            'name' => $name,
            'amount' => $amount,
            'cinema_id' => $cinema_id,
            'show_id' => $show_id,
            'screen_id' => $screen_id,
            'movie_id' => $movie_id,
            'seat_array' => $seats,
        ]);
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
        $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
        $movies = Movie::pluck('name', 'id')->all();
        $ticketCount = array();
        for ($i = 1; $i <= 10; $i++) {
            array_push($ticketCount, $i);
        }

        return view('operator.seats.index', compact('cinemas', 'movies', 'ticketCount'));
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use App\Models\OperatorUser;
use Error;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

class CinemaController extends Controller
{
    public function __construct()
    {
        $title = "Cinemas";
        View::share('title', $title);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.cinemas.index');
    }

    public function dataTable()
    {
        return Datatables::of(Auth::user()->operator->cinemas()->with('city'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cinemas';
        $cities = City::pluck('name', 'id')->all();
        return view('operator.cinemas.create', compact('cities', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                'name' => 'required|max:50',
                'city_id' => 'required',
                'address' => 'required|max:255',
                'pincode' => 'required|max:15',
            ],
            [
                'city_id' => 'City must be selected.'
            ]
        );

        Auth::user()->operator->cinemas()->create($validated);

        return redirect()->route('cinemas.index')->with('message', 'Data added Successfully');
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
        // return Auth::user()->operator->cinemas()->findOrFail($id);
        try {
            $cinema = Auth::user()->operator->cinemas()->findOrFail($id);
            $cities = City::pluck('name', 'id')->all();

            $title = 'Cinemas';
            return view('operator.cinemas.edit', compact('cinema', 'cities', 'title'));
        } catch (Exception $e) {
            return redirect()->route('cinemas.index');
        }
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
        $request->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:255',
            'pincode' => 'required|max:15',
        ]);

        try {
            $cinema = Auth::user()->operator->cinemas()->findOrFail($id);

            $cinema->fill($request->all());

            if ($cinema->isDirty()) {
                $cinema->save();
                return redirect()->route('cinemas.index')->with('message', 'Data updated Successfully');
            }

            return redirect()->route('cinemas.index')->with('fail-message', 'Data not Updated');
        } catch (Exception $e) {
            return redirect()->route('cinemas.index');
        }
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
            Cinema::find($id)->delete();
            return 'Cinema has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

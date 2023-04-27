<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use App\Models\City;
use App\Models\State;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;

class CityController extends Controller
{
    public function __construct()
    {
        $title = "Cities";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.cities.index');
    }

    public function dataTable()
    {
        $query = DB::table('cities')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->select('cities.id as cities_id', 'cities.name as cities_name', 'states.name as states_name')->get();
        return Datatables::of($query)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::pluck('name', 'id')->all();
        return view('super_admin.cities.create', compact('states'));
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
                'name' => 'required|max:50',
                'state_id' => 'required',
            ],
            [
                'state_id' => 'State must be selected.'
            ]
        );

        City::create($validated);

        return redirect()->route('cities.index')->with('message', 'Data added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $states = State::pluck('name', 'id')->all();
        return view('super_admin.cities.edit', compact('city', 'states'));
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
        ]);

        $city = City::find($id);

        $city->fill($request->all());

        if ($city->isDirty()) {
            $city->save();
            return redirect()->route('cities.index')->with('message', 'Data updated Successfully');
        }

        return redirect()->route('cities.index')->with('fail-message', 'Data not Updated');
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
            City::find($id)->delete();
            return 'City has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\City;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;

class OperatorController extends Controller
{
    public function __construct()
    {
        $title = "Operators";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('super_admin.operators.index');
    }

    public function dataTable()
    {
        return Datatables::of(Operator::with('city'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::pluck('name', 'id')->all();
        return view('super_admin.operators.create', compact('cities'));
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
                'city_id' => 'required',
            ],
            [
                'city_id.required' => 'City must be selected.',
            ]
        );

        Operator::create($validated);

        return redirect()->route('operators.index')->with('message', 'Data added Successfully');
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
        $operator = Operator::find($id);
        $cities = City::pluck('name', 'id')->all();
        return view('super_admin.operators.edit', compact('operator', 'cities'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);

        $operator = Operator::find($id);

        $operator->fill($request->all());

        if ($operator->isDirty()) {
            $operator->save();
            return redirect()->route('operators.index')->with('message', 'Data updated Successfully');
        }

        return redirect()->route('operators.index')->with('fail-message', 'Data not Updated');
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
            Operator::find($id)->delete();
            return 'Operator has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

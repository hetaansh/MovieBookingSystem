<?php

namespace App\Http\Controllers;

use Exception;
use Yajra\DataTables\Facades\DataTables;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StateController extends Controller
{

    public function __construct()
    {
        $title = "States";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.states.index');
    }

    public function dataTable()
    {
        return Datatables::of(State::all())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.states.create');
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
        ],
    );
        
        State::create($validated);

        return redirect() -> route('states.index')->with('message','Data added Successfully');
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
        $state = State::find($id);
        return view('super_admin.states.edit', compact('state'));
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
        
        $state = State::find($id);

        $state->fill($request->all());

        if($state->isDirty()){
            $state->save();
            return redirect()->route('states.index')->with('message','Data updated Successfully');
        }
        
        return redirect()->route('states.index')->with('fail-message','Data not Updated');

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
            State::find($id)->delete();
            return 'State has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

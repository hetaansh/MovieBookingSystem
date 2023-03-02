<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = 'Cinema';
        $heads = [
            'ID',
            'Operator ID',
            'City ID',
            'Name',
            'Address',
            'Pincode',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];
        $data = Cinema::all();
        return view('operator.cinema.index', compact('data','heads','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator.cinema.create');
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
            'name' => 'required',
            'operator_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'pincode' => 'required|max:9',
        ]);

        Cinema::create($validated);

        return redirect() -> route('cinemas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $req = Cinema::find($id);
        $req->delete();

        return redirect()->route('cinemas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Cinema::find($id);

        return view('operator.cinema.edit', compact('data'));
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
        $data = Cinema::find($id);
        $data->name = $request->name;
        $data->operator_id = $request->operator_id;
        $data->city_id = $request->city_id;
        $data->address = $request->address;
        $data->pincode = $request->pincode;
        $data->save();

        return redirect()->route('cinemas.index');
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

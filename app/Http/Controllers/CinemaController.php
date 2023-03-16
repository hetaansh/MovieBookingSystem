<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = 'Cinemas';
        return view('operator.cinemas.index', compact('user'));
    }

    public function dataTable()
    {
        return Datatables::of(Cinema::with('city'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = 'Cinemas';
        $cities = City::pluck('name','id')->all();
        return view('operator.cinemas.create',compact('cities','user'));
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
            'city_id' => 'required',
            'address' => 'required|max:255',
            'pincode' => 'required|max:15',
        ],
        [
            'city_id' => 'City must be selected.'
        ]
    );
        
        Cinema::create($validated);

        return redirect() -> route('cinemas.index')->with('message','Data added Successfully');
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
        $cinema = Cinema::find($id);
        $cities = CIty::pluck('name','id')->all();
        $user = 'Cinemas';

        return view('operator.cinemas.edit', compact('cinema','cities','user'));
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
            'address' => 'required|max:255',
            'pincode' => 'required|max:15',
        ]);
        
        $cinema = Cinema::find($id);

        $cinema->fill($request->all());

        if($cinema->isDirty()){
            $cinema->save();
            return redirect()->route('cinemas.index')->with('message','Data updated Successfully');
        }
        
        return redirect()->route('cinemas.index')->with('fail-message','Data not Updated');
      
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
            Cinema::find($id)->delete();
            return 'Cinema has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

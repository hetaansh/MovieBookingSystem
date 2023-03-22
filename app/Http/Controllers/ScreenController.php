<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Screen;

use Error;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class ScreenController extends Controller
{
    public function __construct()
    {
        $title = "Screen";
        View::share('title', $title);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.screens.index');
    }

    public function dataTable()
    {
        return Datatables::of(Auth::user()->operator->screens()->with('cinema')->select('screens.*'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cinemas = Auth::user()->operator->cinemas()->pluck('name', 'id')->all();
        return view('operator.screens.create', compact('cinemas'));
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
                'cinema_id' => 'required',
                'rows' => 'required|max:3',
                'cols' => 'required|max:3',
            ],
            [
                'cinema_id.required' => 'Cinema must be selected.',
            ]
        );

        Auth::user()->operator->screens()->with('cinema')->create($validated);

        return redirect()->route('screens.index')->with('message', 'Data added Successfully');
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
            $screen = Auth::user()->operator->screens()->with('cinema')->findOrFail($id);
            $cinemas = Cinema::pluck('name', 'id')->all();
            return view('operator.screens.edit', compact('screen', 'cinemas'));
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
        $request->validate([
            'name' => 'required|max:50',
            'rows' => 'required|max:3',
            'cols' => 'required|max:3',
        ]);

        try {
            $screen = Auth::user()->operator->screens()->findOrFail($id);

            $screen->fill($request->all());

            if ($screen->isDirty()) {
                $screen->save();
                return redirect()->route('screens.index')->with('message', 'Data updated Successfully');
            }

            return redirect()->route('screens.index')->with('fail-message', 'Data not Updated');
        } catch (Exception $e) {
            return redirect()->route('screens   .index');
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
            Screen::find($id)->delete();
            return 'Screen has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

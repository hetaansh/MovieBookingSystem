<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use App\Models\OperatorUser;
use Illuminate\Support\Facades\Hash;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class OperatorUserController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = 'Operator Users';
        $heads = [
            'ID',
            'Operator',
            'Name',
            'Email',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];
       
        return view('super_admin.operator_users.index', compact('heads','user'));
    }

    public function dataTable()
    {
        return Datatables::of(OperatorUser::with('operator'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user = 'Operator Users';
        $operators = Operator::all();
        return view('super_admin.operator_users.create',compact('operators','user'));
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
            'operator_id' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'operator_id.required' => 'Operator must be selected.',
        ]
    );
        $validated['password'] = Hash::make($validated['password']);

        OperatorUser::create($validated);

        return redirect() -> route('operatorUsers.index')->with('message','Data added Successfully');
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
        $operator_user = OperatorUser::find($id);
        $operators = Operator::all();
        $user = 'Operator Users';
        // $user = auth()->user()->name;
        // if($operator_users -> name === $user){
        //     return redirect() -> route('operatorUsers.index');
        // };

        return view('super_admin.operator_users.edit', compact('operator_user','operators','user'));
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
            'operator_id' => '',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',

        ]);

        
        $operator_user = OperatorUser::find($id);
        $operator_user->password = Hash::make($operator_user->password);
        $operator_user->fill($request->all())->save();

        


        return redirect()->route('operatorUsers.index')->with('message','Data updated Successfully');
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
            OperatorUser::find($id)->delete();
            return 'Operator User has been deleted!';
        } catch (Exception $e) {
            return response('Contact Support!', 400);
        }
    }
}

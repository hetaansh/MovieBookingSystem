<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperatorUser;
use Illuminate\Support\Facades\Hash;

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
            'Operator ID',
            'Name',
            'Email',
            ['label' => 'Actions', 'no-export' => true, 'width' => 10],
        ];
        $data = OperatorUser::all();
        return view('super_admin.operator_users.index', compact('data','heads','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.operator_users.create');
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
            'email' => 'required',
            'password' => 'required|confirmed|min:9',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        OperatorUser::create($validated);

        return redirect() -> route('operatorUsers.index');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $req = OperatorUser::find($id);
        $req->delete();

        return redirect()->route('operatorUsers.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = OperatorUser::find($id);

        return view('super_admin.operator_users.edit', compact('data'));
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
        $data = OperatorUser::find($id);
        $data->name = $request->name;
        $data->operator_id = $request->operator_id;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->password = Hash::make($data->password);
        $data->save();

        return redirect()->route('operatorUsers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}

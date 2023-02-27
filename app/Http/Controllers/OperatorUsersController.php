<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperatorUser;

class OperatorUsersController extends Controller
{
    public function show(){
        $data = OperatorUser::all();
        return view('admin.showOperatorUsers',compact('data'));
    }

    public function showAddOperatorUsersPage(){
        return view('admin.addOperatorUsers');
    }

    public function AddOperatorUsers(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'city' => 'required',
            'operator' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    
        OperatorUser::create($request->all());
        $data = OperatorUser::all();

        return view('admin.showOperatorUsers',compact('data'));
    }

    public function showEditOperatorUsersPage($id){
        $data = OperatorUser::find($id);

        return view('admin.editOperatorUsers',compact('data'));
    }

    public function EditOperatorUsers(Request $request){
        $req = OperatorUser::find($request->id);
        $req -> name = $request -> name;
        $req -> email = $request -> email;
        $req -> city = $request -> city;
        $req -> operator = $request -> operator;
        $req -> password = $request -> password;
        $req->save();

        $data = OperatorUser::all();

        return view('admin.showOperatorUsers',compact('data'));
    }

    public function deleteOperatorUsers($id){
        $data = OperatorUser::find($id);
        $data -> delete();

        return redirect() -> back();
    }
}


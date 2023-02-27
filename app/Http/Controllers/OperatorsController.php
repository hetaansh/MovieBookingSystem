<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;

class OperatorsController extends Controller
{
    public function show(){
        $data = Operator::all();
        return view('admin.showOperators',compact('data'));
    }

    public function showAddOperatorPage(){
        return view('admin.addOperators');
    }

    public function AddOperator(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'city' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
    
        Operator::create($request->all());
        $data = Operator::all();

        return view('admin.showOperators',compact('data'));
    }

    public function showEditOperatorPage($id){
        $data = Operator::find($id);

        return view('admin.editOperators',compact('data'));
    }

    public function EditOperator(Request $request){
        $req = Operator::find($request->id);
        $req -> name = $request -> name;
        $req -> email = $request -> email;
        $req -> city = $request -> city;
        $req -> password = $request -> password;
        $req->save();

        $data = Operator::all();

        return view('admin.showOperators',compact('data'));
    }

    public function deleteOperator($id){
        $data = Operator::find($id);
        $data -> delete();

        return redirect() -> back();
    }
}


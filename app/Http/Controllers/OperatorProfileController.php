<?php

namespace App\Http\Controllers;

use App\Models\OperatorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OperatorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = OperatorUser::find($id);
        $user = 'Profile';
        return view('operator.profile.index',compact('user','data'));
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
        $user_id = OperatorUser::find($id);

        $validate = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required',
        ]);

        if($request->hasFile('image')) {

            $old = 'profile/images/' . $user_id -> image;
            if(File::exists($old)){
                File::delete($old);
            }
            $file = $request->file('image');
            $extension = $file -> getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('profile/images/',$filename);
            $user_id -> image = $filename;
        }
        $user = $validate;
        
        
        $user_id->fill($user)->save();

        return redirect()->back()->with('message','Data updated Successfully');
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

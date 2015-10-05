<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//validator
use Validator;
//Model
use App\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $v = Validator::make( $request->all() , [
            'first_name'=> 'required|max:255',
            'last_name' => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6',            
            ]);

        if( $v->fails() )
        {   
             return response( $v->errors() ,422); 
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt( $request->password );
        $user->token = str_random(16);
        $user->created_by = \Auth::user()->id;
        $user->save();

        return response( [ 'success'=>true, 'data' => $user ] , 200);        
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
        //
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
       $v = Validator::make( $request->all() , [
            'first_name'=> 'required|max:255',
            'last_name' => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6',            
            ]);
        
        if( $v->fails() )
        {   
             return response( $v->errors() ,422); 
        }

        $user = User::find( $id );

        if( ! $user )
        {
            // users not found
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt( $request->password );
        $user->save();

        return response( [ 'data' => $user ] , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::find( $id );
        
        if( ! $user )
        {
            // users not found
        }        

        $User->delete();//

        return response( [ 'message' => 'done' ] , 200);
    }
}

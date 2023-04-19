<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 
     *
     */
    public function store()
    {
        $token = null;
        // error_log("test:1 " . auth()->user()->name);
        try{
            $token = auth()->user()->createToken('token');
        }
        catch (e){
            error_log(e);
        }
        // error_log("test: " . $token->plainTextToken);
        return ['token' => $token->plainTextToken];
    }
}

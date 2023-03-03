<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SettingsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($user)
    {
        $user = User::findOrFail($user);

        //only allow user to view his/her own setting
        $this->authorize('view', $user->setting);        

        return view('settings', [
            'user' => $user
        ]);
    }
}

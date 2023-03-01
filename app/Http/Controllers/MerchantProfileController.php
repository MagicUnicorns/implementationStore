<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchantProfileController extends Controller
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
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'image'=>['required', 'image'],
        ]);

        auth()->user()->profiles()->create($data);

        dd($request->all());
    }
}

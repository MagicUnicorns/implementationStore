<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MerchantProfile;

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

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->merchantProfiles()->create([
            'name' => $data['name'],
            'image' => $imagePath,
        ]);

        return redirect('settings/' . auth()->user()->id);
    }

    /**
     * Edit a merchant's profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {
        return view('profiles.edit', [
            'profile' => MerchantProfile::find(request('id')),
        ]);
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {

        //TODO do something with the values!

        
        return redirect('settings/' . auth()->user()->id);
    }
}

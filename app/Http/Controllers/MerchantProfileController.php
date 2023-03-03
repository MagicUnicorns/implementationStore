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
        //only allow user to edit his/her own profile
        $this->authorize('update', MerchantProfile::find(request('id')));  

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
        $merchantProfile = MerchantProfile::find(request('id'));

        //only allow user to edit his/her own profile
        $this->authorize('update', $merchantProfile);  

        $data = $request->validate([
            'name'=>'required',
        ]);
        if($request->image){  
            $request->validate([
                'image'=>['image'],
            ]);
            
            //remove old file
            if($merchantProfile->image != ''  && $merchantProfile->image != null){
                $file_old = 'storage/' . $merchantProfile->image;
                unlink($file_old);
            }

            //upload new file
            $data['image'] = request('image')->store('uploads', 'public');

        }

        //update database
        $merchantProfile->update($data);
       
        return redirect('settings/' . auth()->user()->id);
    }

    /**
     * Deletes a merchant's profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Request $request)
    {
        $merchantProfile = MerchantProfile::find(request('id'));

        //only allow user to view his/her own profile
        $this->authorize('delete', $merchantProfile);  

        //delete associated image
        if($merchantProfile->image != ''  && $merchantProfile->image != null){
            $file_old = 'storage/' . $merchantProfile->image;
            unlink($file_old);
        }

        //remove database entry
        MerchantProfile::destroy(request('id'));
        
        return back();
    }
}

<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class AvatarController extends Controller
{
    //

    public function update (UpdateAvatarRequest $request){

        //dd($request->input('avatar'));
        //dd($request->all());
        
         // Store Avatar

         //dd($request->input('avatar'));
         $path = $request->file('avatar')->store('avatars', 'public');
         if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
         }
         auth()->user()->update(['avatar' => $path]);
         return back()->with('message', 'Avatar is changed');
    }
}

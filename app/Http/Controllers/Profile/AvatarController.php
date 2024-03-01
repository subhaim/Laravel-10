<?php

namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Str;


class AvatarController extends Controller
{
    //

    public function update (UpdateAvatarRequest $request){

        //dd($request->input('avatar'));
        //dd($request->all());
        
         // Store Avatar

         //dd($request->input('avatar'));
         //$path = $request->file('avatar')->store('avatars', 'public');
         $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
         if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
         }
         auth()->user()->update(['avatar' => $path]);
         return back()->with('message', 'Avatar is changed');
    }

    public function generate (Request $request){

        $result = OpenAI::images()->create([

            'prompt' => 'A good professional avatar',
            'n' => 2,
            'size' => '512x512',
    
        ]);

        $contents = file_get_contents($result->data[0]->url);
        $filename = Str::random(25);
        Storage::disk('public')->put("avatars/$filename.jpg", $contents);
        if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
         }
         auth()->user()->update(['avatar' => "avatars/$filename.jpg"]);
         return back()->with('msg', 'Avatar is changed from AI');

    }
}

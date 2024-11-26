<?php

namespace App\Http\Controllers;

use App\Models\UserIdPic;
use Illuminate\Http\Request;

class UserIdPicController extends Controller
{
    public function add_id(Request $request){

        $profile_exists = UserIdPic::where('user_id', $request->user_id)->count();

        if ($profile_exists){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imagePath = $request->file('image')->store('images', 'public');

            $get_profile = UserIdPic::where('user_id', $request->user_id)->get();

            foreach ($get_profile as $item_get_profile) {
                $picture = UserIdPic::find($item_get_profile->id);
                $picture->path = $imagePath;
                $picture->filename = $request->file('image')->getClientOriginalName();
                $picture->save();
            }

            return redirect()->back();
        }else{
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imagePath = $request->file('image')->store('images', 'public');

            UserIdPic::create([
                'user_id' => $request->user_id,
                'path' =>  $imagePath,
                'filename' => $request->file('image')->getClientOriginalName(),
            ]);

            return redirect()->back();
        }



    }
}

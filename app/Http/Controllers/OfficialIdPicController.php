<?php

namespace App\Http\Controllers;

use App\Models\OfficialIdPic;
use Illuminate\Http\Request;

class OfficialIdPicController extends Controller
{
    public function add_off_id(Request $request){
        $profile_exists = OfficialIdPic::where('user_id', $request->user_id)->count();

        if ($profile_exists){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imagePath = $request->file('image')->store('images', 'public');

            $get_profile = OfficialIdPic::where('user_id', $request->user_id)->get();

            foreach ($get_profile as $item_get_profile) {
                $picture = OfficialIdPic::find($item_get_profile->id);
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

            OfficialIdPic::create([
                'user_id' => $request->user_id,
                'path' =>  $imagePath,
                'filename' => $request->file('image')->getClientOriginalName(),
            ]);

            return redirect()->back();
        }
    }
}

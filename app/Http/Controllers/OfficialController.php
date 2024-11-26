<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use App\Models\OfficialIdPic;

class OfficialController extends Controller
{
    public function add_official(Request $request){

        $official = Official::create([
            'complete_name' => $request->complete_name,
            'sex' => $request->sex,
            'bday' => $request->bday,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => $request->role,
            'fields' => $request->fields,
            'status' => 'Active',
            'system_id' => date("Ymdhisa"),
        ]);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => 'Add Official: ' . $official->complete_name,
            'date' => date("Y-m-d"),
        ]);


        return response()->json();
    }

    public function edit_official(Request $request)
{
    $official = Official::find($request->off_id);

    // Store original values
    $original = $official->getOriginal();

    // Update the official's details
    $official->complete_name = $request->complete_name;
    $official->sex = $request->sex;
    $official->bday = $request->bday;
    $official->address = $request->address;
    $official->phone = $request->phone;
    $official->role = $request->role;
    $official->fields = $request->fields;
    $official->status = $request->status;
    $official->save();

    // Determine changes
    $changes = [];
    foreach ($official->getChanges() as $field => $newValue) {
        $oldValue = $original[$field];
        if ($oldValue !== $newValue) {
            $changes[] = ucfirst($field) . " changed from '$oldValue' to '$newValue'";
        }
    }

    // Create a concise remarks string
    $remarks = "Official edited: " . implode("; ", $changes);

    // Log the history
    HistoryLog::create([
        'user_id' => auth()->user()->id,
        'role' => auth()->user()->role,
        'transaction_code' => 0,
        'transaction_id' => 0,
        'remarks' => $remarks,
        'date' => date("Y-m-d"),
    ]);

    return response()->json();
}


    public function delete_official(Request $request){
        $official = Official::find($request->off_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => "Official Deleted " . $official->complete_name,
            'date' => date("Y-m-d"),
        ]);

        $official->delete();

        $get_off_pics = OfficialIdPic::where('user_id', $request->off_id)->get();

        foreach($get_off_pics as $item_get_off_pics){
            $off_pic = OfficialIdPic::find($item_get_off_pics->id);
            $off_pic->delete();
        }
        return response()->json();
    }


    public function edit_official_v2(Request $request){
        $official = Official::find($request->off_id);
        $official->complete_name = $request->complete_name;
        $official->sex = $request->sex;
        $official->bday = $request->bday;
        $official->address = $request->address;
        $official->phone = $request->phone;
        $official->role = $request->role;
        $official->fields = $request->fields;
        $official->status = $request->status;
        $official->save();

        return redirect()->back();
    }




}

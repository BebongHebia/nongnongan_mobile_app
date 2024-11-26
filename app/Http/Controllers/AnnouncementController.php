<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\Kagawad;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function add_announcement(Request $request){
        Announcement::create([
            'added_by' => $request->added_by,
            'title' => $request->title,
            'details' => $request->details,
        ]);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => $request->title . 'Announcement',
            'date' => date("Y-m-d"),
        ]);

        return response()->json();
    }

    public function edit_announcement(Request $request){
        $ann = Announcement::find($request->ann_id);
        $remarks = "From " . $ann->title . " to " . $request->title . " from : " .  $ann->details . " to " . $request->details;

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => 'Edit Announcement: ' . $remarks,
            'date' => date("Y-m-d"),
        ]);

        $ann->title = $request->title;
        $ann->details = $request->details;
        $ann->save();

        return response()->json();

    }

    public function delete_announcement(Request $request){
        $ann = Announcement::find($request->ann_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => 'Delete Announcement ' . $ann->title,
            'date' => date("Y-m-d"),
        ]);

        $ann->delete();
        return response()->json();
    }


}

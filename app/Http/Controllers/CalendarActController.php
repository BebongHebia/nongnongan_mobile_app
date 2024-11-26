<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\CalendarAct;
use Illuminate\Http\Request;

class CalendarActController extends Controller
{

    public function add_cal_act(Request $request){
        $calendar = CalendarAct::create([
            'activity' => $request->activity,
            'date' => $request->date,
            'status' => 'Pending',
        ]);


        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => 'Activity Added ' . $calendar->activity,
            'date' => date("Y-m-d"),
        ]);

        return response()->json();
    }

    public function edit_cal_act(Request $request){

        $cal_act = CalendarAct::find($request->cal_cat_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => 'Edited Calendary Activity' . $cal_act->activity . " From : " . $cal_act->activity . " To : " . $request->activity . " From : " . $cal_act->date . " To : " . $request->date . " From : " . $cal_act->status . " To : " . $request->status ,
            'date' => date("Y-m-d"),
        ]);


        $cal_act->activity = $request->activity;
        $cal_act->date = $request->date;
        $cal_act->status = $request->status;
        $cal_act->save();
        return response()->json();
    }

    public function delete_cal_act(Request $request){
        $cal_act = CalendarAct::find($request->cal_cat_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => 'Deleted Calendary Activity' . $cal_act->activity,
            'date' => date("Y-m-d"),
        ]);

        $cal_act->delete();
        return response()->json();
    }

    public function getEvents()
{
    $events = CalendarAct::all()->map(function($event) {
        // Define color mappings for each status
        $colorMap = [
            'Done' => '#28a745',      // Green
            'Ongoing' => '#ffc107',   // Yellow
            'Pending' => '#ed0000',   // Red
            'Cancelled' => '#6c757d', // Gray
        ];

        // Use the color based on the status or a default if status is not in the map
        $color = $colorMap[$event->status] ?? '#007bff'; // Default color (blue)

        return [
            'id' => $event->id,
            'title' => $event->activity,
            'start' => $event->date,
            'backgroundColor' => $color,
            'borderColor' => $color,
            'allDay' => true,
        ];
    });

    return response()->json($events);
}


}

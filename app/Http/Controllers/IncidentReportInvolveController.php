<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReportInvolve;

class IncidentReportInvolveController extends Controller
{
    public function add_personel(Request $request){
        IncidentReportInvolve::create([
            'transaction_id' => $request->transaction_id,
            'complete_name' => $request->complete_name,
            'address' => $request->address,
        ]);

        return response()->json();
    }

    public function remove_personel(Request $request){

        $respondent = IncidentReportInvolve::find($request->res_id);
        $respondent->delete();
        return response()->json();
    }
}

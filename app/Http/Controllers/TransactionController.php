<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function receive_transactions(Request $request){
        $transaction = Transaction::find($request->trans_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' =>  auth()->user()->role,
            'transaction_code' => $transaction->transaction_code,
            'transaction_id' => $transaction->id,
            'remarks' => "Transaction Recieved by " . auth()->user()->complete_name . " Requested by : " . $transaction->get_user->complete_name . " Document : " . $transaction->document_type,
            'date' => date("Y-m-d:h:i:s"),
        ]);

        $transaction->status = "Received";
        $transaction->remarks = "-" . $request->remarks;
        $transaction->schedule = $request->schedule;
        $transaction->payable = $request->payable;
        $transaction->save();

        if (auth()->user()->role == "Admin"){
            return redirect('/admin-transactions');
        }elseif (auth()->user()->role == "Staff-Secretary"){
            return redirect('/secretary-transactions');
        }

    }

    public function decline_transactions(Request $request){
        $transaction = Transaction::find($request->trans_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' =>  auth()->user()->role,
            'transaction_code' => $transaction->transaction_code,
            'transaction_id' => $transaction->id,
            'remarks' => "Transaction Decline by " . auth()->user()->complete_name . " Requested by : " . $transaction->get_user->complete_name . " Document : " . $transaction->document_type . " decline for the reasons : " . $request->remarks,
            'date' => date("Y-m-d:h:i:s"),
        ]);

        $transaction->status = "Decline";
        $transaction->remarks = $request->remarks;
        $transaction->save();
        if (auth()->user()->role == "Admin"){
            return redirect('/admin-transactions');
        }elseif (auth()->user()->role == "Staff-Secretary"){
            return redirect('/secretary-transactions');
        }

    }

    public function print_transactions(Request $request){

        $transaction = Transaction::find($request->trans_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' =>  auth()->user()->role,
            'transaction_code' => $transaction->transaction_code,
            'transaction_id' => $transaction->id,
            'remarks' => "Transaction Completed by " . auth()->user()->complete_name . " Requested by : " . $transaction->get_user->complete_name . " Document : " . $transaction->document_type,
            'date' => date("Y-m-d:h:i:s"),
        ]);

        $transaction->status = "Completed";
        $transaction->or_no = $request->or_no;
        $transaction->validity = $request->validity;
        $transaction->save();
        return redirect('/print-transactions-complete/trans-id=' . $request->trans_id);
    }
}

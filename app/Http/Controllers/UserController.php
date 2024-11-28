<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserIdPic;
use App\Models\HistoryLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function register(Request $request){
        if ($request->password == $request->c_password){
            $user = User::create([
                'complete_name' => $request->complete_name,
                'purok' => $request->purok,
                'bday' => $request->bday,
                'phone' => $request->phone,
                'username' => $request->username,
                'password' => $request->password,
                'user_password' => $request->password,
                'sex' => $request->sex,
                'role' => 'User',
                'status' => 'Active',
            ]);

            Auth::login($user);

            HistoryLog::create([
                'user_id' => 0,
                'role' => 0,
                'transaction_code' => 0,
                'transaction_id' => 0,
                'remarks' => "New Account Registered " . $user->complete_name,
                'date' => date("Y-m-d"),
            ]);

            Alert::success('Success', 'Registration Completed');

            return redirect('/user-dashboard');
        }
        else{
            Alert::warning('Error', 'Password Does not match please try again');
            return redirect()->back();
        }
    }

    public function login(Request $request){
        $inputs = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($inputs)) {
            $request->session()->regenerate();

            $user_id = auth()->user()->id;
            $get_user_info = User::find($user_id);
            $user_role = $get_user_info['role'];

            if($user_role == "Admin"){
                return redirect('/admin-dashboard');
            }elseif ($user_role == "User"){
                return redirect('/user-dashboard');
            }elseif ($user_role == "Staff-Secretary"){
                return redirect('/secretary-dashboard');
            }

            HistoryLog::create([
                'user_id' => auth()->user()->id,
                'role' => 0,
                'transaction_code' => 0,
                'transaction_id' => 0,
                'remarks' => "Accoun Logged In " . auth()->user()->complete_name,
                'date' => date("Y-m-d h:i:sa"),
            ]);

        }else{
            return redirect()->back()->withErrors(['message' => 'Sorry, System didnt recognize any account, please check credentials and try again. Thank you']);
        }
    }

    public function logout(){


        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => 0,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => "Accoun Logged Out " . auth()->user()->complete_name,
            'date' => date("Y-m-d:h:i:sa"),
        ]);
        Auth::logout();
        return redirect('/');


    }

    public function add_user(Request $request){

        $get_latest_user_id = User::latest()->first();

        $user = User::create([
            'complete_name' => $request->complete_name,
            'purok' => $request->purok,
            'sex' => $request->sex,
            'bday' => $request->bday,
            'phone' => $request->phone,
            'civil_status' => $request->civil_status,
            'place_of_birth' => $request->place_of_birth,
            'citizenship' => $request->citizenship,
            'region' => $request->region,
            'province' => $request->province,
            'city_muni' => $request->city_muni,
            'barangay' => $request->barangay,
            'profession' => $request->profession,
            'role' => $request->role,
            'status' => 'Active',
            'username' => date("Ymd") . $get_latest_user_id->id,
            'password' => date("Ymd") . $get_latest_user_id->id,
            'user_password' => date("Ymd") . $get_latest_user_id->id,
        ]);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->id,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => "Adding User " . $user->complete_name . " Role : " . $request->role,
            'date' => date("Y-m-d:h:i:s"),
        ]);

        return response()->json();
    }

    public function edit_user(Request $request){



        $user = User::find($request->user_id);
        // Store original values
        $original = $user->getOriginal();
        $user->complete_name = $request->complete_name;
        $user->purok = $request->purok;
        $user->sex = $request->sex;
        $user->bday = $request->bday;
        $user->civil_status = $request->civil_status;
        $user->place_of_birth = $request->place_of_birth;
        $user->citizenship = $request->citizenship;
        $user->region = $request->region;
        $user->province = $request->province;
        $user->city_muni = $request->city_muni;
        $user->barangay = $request->barangay;
        $user->profession = $request->profession;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->save();

        // Determine changes
        $changes = [];
        foreach ($user->getChanges() as $field => $newValue) {
            $oldValue = $original[$field];
            if ($oldValue !== $newValue) {
                $changes[] = ucfirst($field) . " changed from '$oldValue' to '$newValue'";
            }
        }

        // Create a concise remarks string
            $remarks = "User edited: " . implode("; ", $changes);

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

    public function delete_user(Request $request){

        $get_user_transaction_code = Transaction::where('user_id', $request->user_id)->count();

        if ($get_user_transaction_code > 0){
            $get_user_transaction_code_list = Transaction::where('user_id', $request->user_id)->get();

            foreach($get_user_transaction_code_list as $items_get_user_transaction_code_list){
                $get_transaction = Transaction::find($items_get_user_transaction_code_list->id);
                $get_transaction->delete();
            }
        }

        $get_user_pics = UserIdPic::where('user_id', $request->user_id)->get();
        foreach($get_user_pics as $items_get_user_pics){
            $pics = UserIdPic::find($items_get_user_pics->id);
            $pics->delete();
        }

        $user = User::find($request->user_id);

        HistoryLog::create([
            'user_id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'transaction_code' => 0,
            'transaction_id' => 0,
            'remarks' => "Delete User : " . $user->complete_name,
            'date' => date("Y-m-d"),
        ]);

        $user->delete();
        return response()->json();
    }

    public function update_user_profile(Request $request){
        $user = User::find($request->user_id);
        $user->complete_name = $request->complete_name;
        $user->purok = $request->purok;
        $user->sex = $request->sex;
        $user->bday = $request->bday;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back();
    }

    public function search_account_recover(Request $request){
        $search_account_recovery_result = User::where('phone', $request->phone)->where('username', $request->username)->count();



        if ($search_account_recovery_result){
            $user_details = User::where('phone', $request->phone)->where('username', $request->username)->first();
            return view('recover_account', ['user_details' => $user_details]);
        }else{
            return redirect()->back()->withErrors(['message' => 'Sorry no account has been found please try again']);
        }
    }

    public function change_password(Request $request){


        if ($request->password == $request->confirm_password){
            $get_user = User::find($request->user_id);
            $get_user->password = bcrypt($request->password);
            $get_user->save();

            Alert::success('Password change successfully');

            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['message' => 'Password does not match. please try again']);
        }
    }



}

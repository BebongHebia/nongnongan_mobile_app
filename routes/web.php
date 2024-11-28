<?php

use App\Models\User;
use App\Models\Kagawad;
use App\Models\Official;
use App\Models\CalendarAct;
use App\Models\Transaction;
use App\Models\Announcement;
use App\Models\IncidentReportInvolve;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KagawadController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\UserIdPicController;
use App\Http\Controllers\CalendarActController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\KagawadIdPicController;
use App\Http\Controllers\OfficialIdPicController;
use App\Http\Controllers\IncidentReportInvolveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Fetching
Route::get('/get-staff-kap', function(){
    $staff_kap = User::where('role', 'Staff-Kapitan')->get();
    return response()->json($staff_kap);
});

Route::get('/get-staff-sec', function(){
    $staff_sec = User::where('role', 'Staff-Secretary')->get();
    return response()->json($staff_sec);
});

Route::get('/get-users', function(){
    $users = User::where('role', 'User')->get();
    return response()->json($users);
});

Route::get('/fetch-announcement', function(){
    $announcement = Announcement::all();

    return response()->json($announcement);
});

Route::get('/fetch-official', function(){
    $official = Official::all();

    return response()->json($official);
});

Route::get('/fetch-cal-act', function(){
    $cal_act = CalendarAct::all();

    return response()->json($cal_act);
});

Route::get('/fetch-personels/transaction-id={transaction_id}', function($transaction_id){
    $persons = IncidentReportInvolve::where('transaction_id', $transaction_id)->get();
    return response()->json($persons);
});


//Function
Route::post('/add-user', [UserController::class, 'add_user']);
Route::post('/edit-user', [Usercontroller::class, 'edit_user']);
Route::post('/delete-user', [UserController::class, 'delete_user']);
Route::post('/receive-transactions', [TransactionController::class, 'receive_transactions']);
Route::post('/decline-transactions', [TransactionController::class, 'decline_transactions']);
Route::post('/print-transactions', [TransactionController::class, 'print_transactions']);
Route::post('/transaction-add-id', [UserIdPicController::class, 'add_id']);
Route::post('/add-announcement', [AnnouncementController::class, 'add_announcement']);
Route::post('/edit-announcement', [AnnouncementController::class, 'edit_announcement']);
Route::post('/delete-announcement', [AnnouncementController::class, 'delete_announcement']);

Route::post('/add-official', [OfficialController::class, 'add_official']);
Route::post('/edit-official', [OfficialController::class, 'edit_official']);
Route::post('/delete-official', [OfficialController::class, 'delete_official']);

Route::post('/add-off-id', [OfficialIdPicController::class, 'add_off_id']);
Route::post('/update-official-profile', [OfficialController::class, 'edit_official_v2']);

Route::post('/add-cap-calendar', [CalendarActController::class, 'add_cal_act']);
Route::post('/edit-cal-act', [CalendarActController::class, 'edit_cal_act']);
Route::post('/delete-cal-act', [CalendarActController::class, 'delete_cal_act']);

Route::get('/api/calendar-events', [CalendarActController::class, 'getEvents']);

Route::post('/add-involve', [IncidentReportInvolveController::class, 'add_personel']);
Route::post('/remove-involve', [IncidentReportInvolveController::class, 'remove_personel']);

Route::get('/', function () {
    return view('login');
});

Route::get('/create-account', function(){
    return view('register');
});

//Create Account
Route::post('/register', [UserController::class, 'register']);

//Login
Route::post('/login', [UserController::class, 'login']);

//Logout
Route::post('/logout', [Usercontroller::class, 'logout']);

Route::get('/user-dashboard', function(){
    if (Auth::check() && auth()->user()->role == 'User'){
        return view('users.dashboard');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-dashboard', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.dashboard');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-users', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.users');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-staff-kapitan', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.staff_kapitan');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-staff-secretary', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.staff_secretary');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-officials', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.officials');
    }else{
        return redirect('/');
    }
});

Route::get('/view-officials={off_id}', function($off_id){
    if (Auth::check() && auth()->user()->role == 'Admin'){

        $official_details = Official::find($off_id);

        return view('admin.official_profile', ['official_details' => $official_details]);
    }else if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        $official_details = Official::find($off_id);

        return view('Secretary.official_profile', ['official_details' => $official_details]);
    }
    else{
        return redirect('/');
    }
});


Route::get('/view-user={user_id}', function($user_id){
    if (Auth::check() && auth()->user()->role == 'Admin'){

        $user_details = User::find($user_id);

        return view('admin.user_profile', ['user_details' => $user_details]);
    }else if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        $user_details = User::find($user_id);

        return view('Secretary.user_profile', ['user_details' => $user_details]);
    }
    else{
        return redirect('/');
    }
});




Route::get('/admin-org-charts', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.organization_chart');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-transactions', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){

        $transactions = Transaction::all();

        return view('admin.transactions', ['transactions' => $transactions]);
    }else{
        return redirect('/');
    }
});

Route::get('/admin-announcements', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){


        return view('admin.announcement');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-announcements/id={ann_id}', function($ann_id){
    if (Auth::check() && auth()->user()->role == 'Admin'){

        $ann_details = Announcement::find($ann_id);
        return view('admin.view_announcement', ['ann_details' => $ann_details]);
    }elseif (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        $ann_details = Announcement::find($ann_id);
        return view('Secretary.view_announcement', ['ann_details' => $ann_details]);
    }
    else{
        return redirect('/');
    }
});


Route::get('/admin-transactions/document-type={doc_type}/transaction-id={trans_id}', function($doc_type, $trans_id){
    if (Auth::check() && auth()->user()->role == 'Admin'){

        $transactions = Transaction::find($trans_id);

        return view('admin.view_transactions', ['transactions' => $transactions]);
    }elseif (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        $transactions = Transaction::find($trans_id);

        return view('Secretary.view_transactions', ['transactions' => $transactions]);
    }
    else{
        return redirect('/');
    }
});

Route::get('/admin-kap-calendar', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.cap_calendar');
    }else{
        return redirect('/');
    }
});

Route::get('/admin-log', function(){
    if (Auth::check() && auth()->user()->role == 'Admin'){
        return view('admin.logs');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-dashboard', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.dashboard');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-staff-kapitan', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.staff_kapitan');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-officials', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.officials');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-users', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.users');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-transactions', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        $transactions = Transaction::all();

        return view('Secretary.transactions', ['transactions' => $transactions]);
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-org-charts', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.organization_chart');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-announcements', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){


        return view('Secretary.announcement');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-kap-calendar', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.cap_calendar');
    }else{
        return redirect('/');
    }
});

Route::get('/secretary-log', function(){
    if (Auth::check() && auth()->user()->role == 'Staff-Secretary'){
        return view('Secretary.logs');
    }else{
        return redirect('/');
    }
});

Route::get('/forgot-password', function(){
    return view('forgot_password');
});

Route::post('/search-account-for-recovery', [Usercontroller::class, 'search_account_recover']);
Route::post('/change-password', [Usercontroller::class, 'change_password']);

Route::get('/print-transactions-complete/trans-id={trans_id}', function($trans_id){
    $transactions = Transaction::find($trans_id);
    return view('print', ['transactions' => $transactions]);
});

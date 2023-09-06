<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Session;
use App\Models\Section;
use App\Models\Event_Meta;
use App\Models\Registeruser;
use App\Mail\userregistermail;
use Illuminate\Support\Facades\Mail;

class FrontHomeController extends Controller
{
   public function index(){

    return view('Front.homepage');
   }
   public function detail($code){
    
    $events = Events::where('rsvp_code',$code)->with('session')->first();
    if(!$events){
        abort(404);
    }
    if($events->session_type == 'multiple'){
        $multiple_session = Session::where('parent_session',$events->session['id'])->get();
    }else{
        $multiple_session = null;
    }
    $section = Section::where('event_id',$events->id)->with('event_data')->orderBy('section_number','asc')->get();
    // dd($section);
    return view('Front.eventdetail',compact('events','section','multiple_session'));
   }

   
   public function codecheck(Request $request){
    $events = Events::where('rsvp_code',$request->code)->first();
    if($events){
        return response()->json(url($events->rsvp_code));
    }else{
        return response()->json('error');
    }

   }
   public function submitproc(Request $request){
    // echo '<pre>';
    // print_r($request->all());
    // echo '</pre>';
    // print_r($request->guest_first_name);
    // print_r($request->guest_last_name);
    
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'mobile_phone' => 'required',
        'email' => 'required',
        'address' => 'required',
        'apt' => 'required',
    ]);
    $fullname = array();
    if($request->guest_first_name){
    for ($i=0; $i < count($request->guest_first_name); $i++) { 
        array_push($fullname,$request->guest_first_name[$i].' ' .$request->guest_last_name[$i]);
    }
}
    $events = Events::find($request->event_id);
    $registeruser = new Registeruser();
    $registeruser->first_name = $request->first_name;
    $registeruser->last_name = $request->last_name;
    $registeruser->mobile_number = $request->mobile_phone;
    $registeruser->email = $request->email;
    $registeruser->address = $request->address;
    $registeruser->event_date = $request->event_date;
    $registeruser->guests = json_encode($fullname);
    $registeruser->apt = $request->apt;
    $registeruser->note = $request->note;
    $registeruser->event_id = $request->event_id;
    $registeruser->save();

    $session_data = Session::find($request->event_date);

    $mailData = [
        'fullname' => $request->first_name.' '.$request->last_name,
        'email' => $request->email,
        'event_data' => $events,
        'session_data' => $session_data,

    ];

    $mail = Mail::to($request->email)->send(new userregistermail($mailData));

    return redirect()->back()->with(['success'=>'You are successfully register for this event']);
    
}
}

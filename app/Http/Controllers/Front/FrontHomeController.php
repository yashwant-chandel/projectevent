<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Session;
use App\Models\Section;
use App\Models\Event_Meta;

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
    echo '<pre>';
    print_r($request->all());
    echo '</pre>';
   }
}

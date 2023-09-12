<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Events;
use App\Models\Session;
use App\Models\Section;
use App\Models\Event_Meta;
use App\Models\Registeruser;

class EventController extends Controller
{
    public function index(){
        $events = Events::all();
        return view('Admin.Events.index');
    }

    public function eventlist(){
        $events = Events::where('status',1)->with('session','section')->get();
        
        return view('Admin.Events.eventlist',compact('events'));
    }
    public function registerlist($rsvp){
        $event = Events::where('rsvp_code',$rsvp)->with('session')->first();
        if(!$event){
            abort(404);
        }
        $registerusers = Registeruser::where('event_id',$event->id)->with('event_dates')->get();
        // dd($registerusers);
        return view('Admin.Events.userlist',compact('registerusers','event'));
    }
    public function edit($rsvp){
        $event = Events::where('rsvp_code',$rsvp)->with('session')->first();
        // dd($event);
        
        if(!$event){
            abort(404);
        }
        $section = Section::where('event_id',$event->id)->with('event_data')->orderBy('section_number','asc')->get();
        $subsession = Session::where([['event_id',$event->id],['parent_session',$event->session['id']]])->get();
          
        return view('Admin.Events.edit',compact('event','section','subsession','rsvp'));
    }
    public function submitProc(Request $request){
      
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die();
        // if($request->)
        // |unique:events,title
           
        $request->validate([
            'title' => 'required',
            'rsvp_code' => 'required|unique:events,rsvp_code',
            'subtitle' => 'required',
            'file' => 'required',
            'background_image' => 'required',
        ],[
            'rsvp_code.unique' => 'This event code has already been taken',
        ]);
        if($request->session_type == 'Please select'){
            return redirect()->back()->with(['error'=>'Please select event type']);
        }
        if($request->hasfile('file')){
            $file = $request->file('file');
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/image/', $name);
        }
        if($request->hasfile('background_image')){
            $file1 = $request->file('background_image');
            $background_image_name = time().rand(1,100).'.'.$file1->extension();
        
            $file1->move(public_path().'/image/', $background_image_name);
        }
        // die();
      
        $selchr = substr($request->title,0, 9);
        $caps = strtoupper($selchr);
       
        $events = new Events;
        $events->title = $request->title;
        // $events->rsvp_code = str_replace(" ","-",substr_replace($request->title, $caps,0)).rand(1,99);
        $events->rsvp_code = $request->rsvp_code;
        $events->sub_title = $request->subtitle;
        $events->logo = $name;
        $events->logo_path = '/image/'.$name;
        $events->background_image = '/image/'.$background_image_name;
        $events->session_type = $request->session_type;
        $events->save();
        // die();
        if($request->session_type == 'single'){
            $single_session = new Session;
            $single_session->start_date = $request->singlesession_start_date;
            $single_session->start_time = $request->singlesession_start_time;
            $single_session->place = $request->singlesession_place;
            $single_session->note = $request->singlesession_note;
            $single_session->close_date = $request->singlesession_close_date;
            $single_session->event_id = $events->id;
            $single_session->save();
        }else{
            $multi_session = new Session;
            $multi_session->start_date = $request->multisession_start_date;
            $multi_session->close_date = $request->multisession_close_date;
            $multi_session->note = $request->multisesion_note;
            $multi_session->event_id = $events->id;
            $multi_session->save();
            if($request->session_start_sub_date){
            for ($i=0; $i < count($request->session_start_sub_date); $i++) {
                if($request->session_start_sub_date[$i] != null && $request->session_start_sub_date[$i] != null){
                    $multi_sub_session = new Session;
                    $multi_sub_session->start_date = $request->session_start_sub_date[$i];
                    $multi_sub_session->start_time = $request->session_start_sub_time[$i];
                    $multi_sub_session->place = $request->session_sub_place[$i];
                    $multi_sub_session->event_id = $events->id;
                    $multi_sub_session->parent_session = $multi_session->id;
                    $multi_sub_session->save();
                }
            }
            }

        }
        // die();

        // for ($i=0; $i < count($request->session_start_date); $i++) { 
        //     if($request->session_start_date[$i] != null && $request->session_start_time[$i] != null){
        //     $session = new Session;
        //     $session->date = $request->session_start_date[$i];
        //     $session->time = $request->session_start_time[$i];
        //     $session->place = $request->session_place[$i];
        //     $session->note = $request->note[$i];
        //     $session->close_date = $request->session_close_date[$i];
        //     $session->save();
        //     }
        // }
// die();
        if($request->sections){
           
          
            $count = 0;
            $text_count = 0;
            $right_count = 0;
            $left_count = 0;
            $gallery_count = 0;
            $contact_count = 0;
            $footer_count =0;
            foreach($request->sections as $data){
                if($data == null || $data == ''){
                    continue;
                }
                $count = $count+1;
                if($data == 'text_editor'){
                    try {
                    $section = new Section;
                    $section->title = $request->text_editor_title[$text_count];
                    $section->slug = str_replace(" ","-",$request->text_editor_title[$text_count]);
                    $section->section_name = 'text-editor-section';
                    $section->section_number = $count;
                    $section->event_id = $events->id;
                    $section->save();

                    $textarea = new Event_Meta;
                    $textarea->text_editor = $request->text_editor_text[$text_count];
                    $textarea->event_id = $events->id;
                    $textarea->section_id = $section->id;
                    $textarea->save();
                    $text_count = $text_count+1;
                } catch (\Throwable $th) {
                   
                }
                   
                }elseif($data == 'right_image_section'){

                    try{
                    $section1 = new Section;
                    $section1->title = $request->text_editor_title[$right_count];
                    $section1->slug = str_replace(" ","-",$request->text_editor_title[$right_count]);
                    $section1->section_name = 'right-image-section';
                    $section1->section_number = $count;
                    $section1->event_id = $events->id;
                    $section1->save();

                    if($request->hasfile('right_section_image')){
                        $right_section_image = $request->file('right_section_image');
                      
                        $right_section_image_name = time().rand(1,100).'.'.$right_section_image[$right_count]->extension();
                        $right_section_image[$right_count]->move(public_path().'/image/', $right_section_image_name);

                    }else{
                        $right_section_image_name = '123.jpg';
                    }

                    $right_image_section = new Event_Meta;
                    $right_image_section->right_image_with_left_text_caption = $request->right_section_caption[$right_count];
                    $right_image_section->right_image_with_left_text_image = $right_section_image_name;
                    $right_image_section->right_image_with_left_text_description = $request->right_section_description[$right_count];
                    $right_image_section->event_id = $events->id;
                    $right_image_section->section_id = $section1->id;
                    $right_image_section->save();
                    $right_count = $right_count+1;
                    // die();
                    } catch (\Throwable $th) {
                    
                    }
                }
                elseif($data == 'left_image_section'){
                    try{
                    $section2 = new Section;
                    $section2->title = $request->left_section_title[$left_count];
                    $section2->slug = str_replace(" ","-",$request->left_section_title[$left_count]);
                    $section2->section_name = 'left-image-section';
                    $section2->section_number = $count;
                    $section2->event_id = $events->id;
                    $section2->save();

                    if($request->hasfile('left_section_image')){
                        $left_section_image = $request->file('left_section_image');
                        $left_section_image_name = time().rand(1,100).'.'.$left_section_image[$left_count]->extension();
                    
                        $left_section_image[$left_count]->move(public_path().'/image/', $left_section_image_name);
                    }else{
                        $right_section_image_name = '123.jpg';
                    }

                    $left_image_section = new Event_Meta;
                    $left_image_section->left_image_with_right_text_caption = $request->left_section_caption[$left_count];
                    $left_image_section->left_image_with_right_text_image	 = $left_section_image_name;
                    $left_image_section->left_image_with_right_text_description = $request->left_section_description[$left_count];
                    $left_image_section->event_id = $events->id;
                    $left_image_section->section_id = $section2->id;
                    $left_image_section->save();
                    $left_count = $left_count+1;
                } catch (\Throwable $th) {
                   
                }
                }elseif($data == 'gallery_section'){
             
                    $section3 = new Section;
                    $section3->title = $request->Gallery_section_title[$gallery_count];
                    $section3->slug = str_replace(" ","-",$request->Gallery_section_title[$gallery_count]);
                    $section3->section_name = 'gallery-section';
                    $section3->section_number = $count;
                    $section3->event_id = $events->id;
                    $section3->save();

                //    try {
                    //code...
                  
                    if($request->hasFile('gallery_images')){
                        $gallery_images = $request->file('gallery_images');
                        if($gallery_count == 0){
                        for ($num=0; $num < $request->images_count[$gallery_count]; $num++) { 
                          $extension = $gallery_images[$num]->getClientOriginalExtension();
                          $file_name = 'gallery_'.rand(0,1000).time().'.'.$extension;
                          $gallery_images[$num]->move(public_path().'/image/',$file_name);
                          $file_names[] = $file_name; 
                        }
                    }else{
                        for ($num=$request->images_count[$gallery_count-1]; $num < $request->images_count[$gallery_count]; $num++) { 
                            $extension = $gallery_images[$num]->getClientOriginalExtension();
                            $file_name = 'gallery_'.rand(0,1000).time().'.'.$extension;
                            $gallery_images[$num]->move(public_path().'/image/',$file_name);
                            $file_names[] = $file_name; 
                          } 
                    }
                    }else{
                        $file_names = ["123.jpeg"];
                    }
                // } catch (\Throwable $th) {
                //     //throw $th;
                //    }
                    // print_r($file_names);
                    // die();
                    $gallery_section = new Event_Meta;
                    $gallery_section->gallery_section_images = json_encode($file_names);
                    $gallery_section->event_id = $events->id;
                    $gallery_section->section_id = $section3->id;
                    $gallery_section->save();
                   $gallery_count = $gallery_count+1;
               
                }elseif($data == 'contact_section'){
                    try{
                        $section4 = new Section;
                        $section4->title = $request->contact_section_title[$contact_count];
                        $section4->slug = str_replace(" ","-",$request->contact_section_title[$contact_count]);
                        $section4->section_name = 'contact-section';
                        $section4->section_number = $count;
                        $section4->event_id = $events->id;
                        $section4->save();

                        $contact_section = new Event_Meta;
                        $contact_section->contact_section_address = $request->address[$contact_count];
                        $contact_section->contact_section_contact	 = $request->phone[$contact_count];
                        $contact_section->contact_section_email = $request->email[$contact_count];
                        $contact_section->contact_section_site_address = $request->site_address[$contact_count];
                        $contact_section->map_status = $request['map'.$contact_count];
                        $contact_section->event_id = $events->id;
                        $contact_section->section_id = $section4->id;
                        $contact_section->save();
                        $contact_count = $contact_count+1;
                    } catch (\Throwable $th) {
                    
                    }
                }elseif($data == 'footer_section'){
                    try{
                        $section5 = new Section;
                        $section5->title = $request->footer_section_title[$footer_count];
                        $section5->slug = str_replace(" ","-",$request->footer_section_title[$footer_count]);
                        $section5->section_name = 'disclaimer_text';
                        $section5->section_number = $count;
                        $section5->event_id = $events->id;
                        $section5->save();

                        $footer_section = new Event_Meta;
                        $footer_section->footer_disclaimer = $request->disclaimer_text[$footer_count];
                        $footer_section->event_id = $events->id;
                        $footer_section->section_id = $section5->id;
                        $footer_section->save();
                        $footer_count = $footer_count+1;
                    } catch (\Throwable $th) {
                    
                    }
                }

            }
        }
        return redirect('/admin-dashboard/edit/'.$events->rsvp_code)->with('success','successfully saved events');
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required',
            'rsvp_code' => 'required|unique:events,rsvp_code,'.$request->id,
            'subtitle' => 'required',
        ],[
            'rsvp_code.unique' => 'This event code has already been taken',
        ]);
        $event = Events::find($request->id);
        $event->title = $request->title;
        // $event->slug = strtolower(str_replace(" ","-",$request->title));
        $event->sub_title = $request->subtitle;
        $event->title = $request->title;
        if($request->hasfile('file')){
            $file = $request->file('file');
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/image/', $name);
            $event->logo = $name;
            $event->logo_path = '/image/'.$name;
        }
        if($request->hasfile('background_image')){
            $file1 = $request->file('background_image');
            $background_image_name = time().rand(1,100).'.'.$file1->extension();
        
            $file1->move(public_path().'/image/', $background_image_name);
            $event->background_image = '/image/'.$background_image_name;
        }
        // $event->session_type = $request->session_type;
        $event->update();
      
        return redirect('/admin-dashboard/edit/'.$event->rsvp_code)->with(['success'=>'successfully updated event data']);

    }
    public function section_update(Request $request){
        if($request->session_type == 'Please select'){
            return redirect()->back()->with(['error'=>'Please select event type']);
        }
        $event = Events::find($request->id);
        $event->session_type = $request->session_type;
        $event->update();

        if($request->session_type == 'single'){
            $single_session = Session::where('event_id',$request->id)->first();
            Session::where([['event_id',$request->id],['parent_session',$single_session->id]])->delete();
            $single_session->start_date = $request->singlesession_start_date;
            $single_session->start_time = $request->singlesession_start_time;
            $single_session->place = $request->singlesession_place;
            $single_session->note = $request->singlesession_note;
            $single_session->close_date = $request->singlesession_close_date;
            $single_session->event_id = $request->id;
            $single_session->update();
        }elseif($request->session_type == 'multiple'){
            
            $multi_session = Session::where([['event_id',$request->id],['parent_session',null]])->first();
            $multi_session->start_date = $request->multisession_start_date;
            $multi_session->close_date = $request->multisession_close_date;
            $multi_session->place = null;
            $multi_session->start_time = null;
            $multi_session->note = $request->multisesion_note;
            $multi_session->event_id = $event->id;
            $multi_session->update();
            $subsession = Session::where([['event_id',$request->id],['parent_session',$multi_session->id]])->get();
            if($request->session_start_sub_date){
            for ($i=0; $i < count($request->session_start_sub_date); $i++) {
                if($request->session_start_sub_date[$i] != null && $request->session_start_sub_date[$i] != null){
                    $multi_sub_session = Session::find($request->session_id[$i]);
                    if(empty($multi_sub_session)){
                        $multi_sub_session = new Session;
                    }
                    $multi_sub_session->start_date = $request->session_start_sub_date[$i];
                    $multi_sub_session->start_time = $request->session_start_sub_time[$i];
                    $multi_sub_session->place = $request->session_sub_place[$i];
                    $multi_sub_session->event_id = $event->id;
                    $multi_sub_session->parent_session = $multi_session->id;
                    $multi_sub_session->save();
                }
            }
        }
    }
        return redirect()->back()->with(['success'=>'successfully updated session']);
    }

    public function deletesession($id){
        $session = Session::find($id);
        if($session){
            $session->delete();
            return redirect()->back()->with(['success'=>'successfully deleted session']);
        }else{
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
    }

    public function delete($id){

        $events = Events::find($id)->delete();
        $session = Session::where('event_id',$id)->delete();
        $section = Section::where('event_id',$id)->delete();
        $event_meta = Event_Meta::where('event_id',$id)->delete();
        
        return redirect()->back()->with('success','successfully deleted data');

    }
}

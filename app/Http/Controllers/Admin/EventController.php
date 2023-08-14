<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Events;
use App\Models\Session;
use App\Models\Section;

class EventController extends Controller
{
    public function index(){
        $events = Events::all();
        // dd($events);
        return view('Admin.Events.index');
    }
    public function submitProc(Request $request){
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
        die();
        $request->valdate([
            'title' => 'required',
            'file' => 'required',
        ]);
        if($request->hasfile('file')){
            $file = $request->file('file');
            $name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/image/', $name);
        }
        if($request->hasfile('background_image')){
            $file = $request->file('background_image');
            $background_image_name = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path().'/image/', $name);
        }
        $events = new Events;
        $events->title = $request->title;
        $events->subtitle = $request->subtitle;
        $events->logo = $name;
        $events->logo_path = '/image/'.$name;
        $events->background_image = '/image/'.$background_image_name;
        $events->save();

        for ($i=0; $i < count($request->session_start_date); $i++) { 
            if($request->session_start_date[$i] != null && $request->session_start_time[$i] != null){
            $session = new Session;
            $session->date = $request->session_start_date[$i];
            $session->time = $request->session_start_time[$i];
            $session->place = $request->session_place[$i];
            $session->note = $request->note[$i];
            $session->close_date = $request->session_close_date[$i];
            $session->save();
            }
        }

        if($request->text_editor_title){
            $section = new Section;
            $section->title = $request->text_editor_title;
            $section->slug = str_repeat(" ","-",$request->text_editor_title);
            $section->section_name = 'text-editor-section';
            $section->save();
        }
        if($request->right_section_title){
            $section1 = new Section;
            $section1->title = $request->right_section_title;
            $section1->slug = str_repeat(" ","-",$request->right_section_title);
            $section1->section_name = 'right-image-section';
            $section1->save();
        }
        if($request->left_section_title){
            $section2 = new Section;
            $section2->title = $request->left_section_title;
            $section2->slug = str_repeat(" ","-",$request->left_section_title);
            $section2->section_name = 'left-image-section';
            $section2->save();
        }
        if($request->Gallery_section_title){
            $section3 = new Section;
            $section3->title = $request->Gallery_section_title;
            $section3->slug = str_repeat(" ","-",$request->Gallery_section_title);
            $section3->section_name = 'gallery-section';
            $section3->save();
        }
        if($request->contact_section_title){
            $section4 = new Section;
            $section4->address = $request->contact_section_title;
            $section4->slug = str_repeat(" ","-",$request->contact_section_title);
            $section4->section_name = 'contact-section';
            $section4->save();
        }
        if($request->footer_section_title){
            $section5 = new Section;
            $section5->address = $request->footer_section_title;
            $section5->slug = str_repeat(" ","-",$request->footer_section_title);
            $section5->section_name = 'disclaimer_text';
            $section5->save();
        }
        
        
        return redirect()->back()->with('success','successfully saved events');
    }
}

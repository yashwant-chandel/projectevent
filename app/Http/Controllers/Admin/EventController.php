<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Events;

class EventController extends Controller
{
    public function index(){
        return view('Admin.Events.index');
    }
    public function submitProc(Request $request){
        print_r($request->all());
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
        $events = new Events;
        $events->title = $request->title;
        $events->logo = $name;
        $events->logo_path = '/image/'.$name;
        $events->save();
        return redirect()->back()->with('success','successfully saved events');
    }
}

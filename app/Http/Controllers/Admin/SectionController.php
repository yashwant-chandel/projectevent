<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Session;
use App\Models\Section;
use App\Models\Event_Meta;

class SectionController extends Controller
{
    public function delete($id){
        $deletesection = Section::find($id);
        $event_id = $deletesection->event_id;
        $deletesection->delete();
        // $deleteeventdata = Event_Meta::where('section_id',$id)->delete();
        $allsection = Section::where('event_id',$event_id)->orderBy('section_number','asc')->get();
        
        $num = 1; 
        foreach($allsection as $section){
            $update = Section::find($section->id);
            $update->section_number = $num;
            $update->update();
            $num = $num+1;
        }
        return redirect()->back()->with('success','successfully deleted section');
    }
    public function update(Request $request){
       if($request->id){
        $section = Section::find($request->id);
        $section->title = $request->title;
        $section->slug = strtolower(str_replace(" ","-",$request->title));
        $section->section_name = $request->section_type;
        $section->section_number = $request->section_number;
        $section->update();
       }else{
        $section = new Section;
        $section->title = $request->title;
        $section->slug = strtolower(str_replace(" ","-",$request->title));
        $section->section_name = $request->section_type;
        $section->section_number = $request->section_number;
        $section->event_id = $request->event_id;
        $section->save();
       }
        if($request->section_type == 'text-editor-section'){
            if($request->id){
            $editor = $this->text_editor($request->id,$request->text_editor_text);
            }else{
                $editor = $this->text_editor_update($section->id,$request->text_editor_text,$request->event_id);
            }
        }if($request->section_type == 'right-image-section'){
            if($request->hasFile('right_section_image')){
                $right_image = $request->file('right_section_image');
                $right_image_name = time().rand(1,100).'.'.$right_image->extension();
            
                $right_image->move(public_path().'/image/', $right_image_name);
            }else{
                $right_image_name = null;
            }
            if($request->id){
            $right_image_section = $this->right_image($request->id,$request->right_section_caption,$request->right_section_description,$right_image_name);
            }else{
                $right_image_section = $this->right_image_update($section->id,$request->right_section_caption,$request->right_section_description,$right_image_name,$request->event_id);
            }
        }elseif($request->section_type == 'left-image-section'){
            if($request->hasFile('left_section_image')){
                $left_image = $request->file('left_section_image');
                $left_image_name = time().rand(1,100).'.'.$left_image->extension();
            
                $left_image->move(public_path().'/image/', $left_image_name);
            }else{
                $left_image_name = null;
            }
            if($request->id){
            $left_image_section = $this->left_image($request->id,$request->left_section_caption,$request->left_section_description,$left_image_name);
            }else{
                $left_image_section = $this->left_image_add($section->id,$request->left_section_caption,$request->left_section_description,$left_image_name,$request->event_id);
            }
        }elseif($request->section_type == 'gallery-section'){


            if($request->hasFile('gallery_images')){
                $gallery_images = $request->file('gallery_images');
             
                foreach($gallery_images as $gallery_image){ 
                  $extension = $gallery_image->getClientOriginalExtension();
                  $file_name = 'gallery_'.rand(0,1000).time().'.'.$extension;
                  $gallery_image->move(public_path().'/image/',$file_name);
                  $file_names[] = $file_name; 
                }
                if($request->id){
                    $gallery_images = $this->gallery($request->id,$file_names);
                }else{
                    $gallery_images = $this->gallery_add($section->id,$file_names,$request->event_id);
                }
            }
               

            
        }elseif($request->section_type == 'contact-section'){
            if($request->id){
                $contact_section = $this->contact($request->id,$request->address,$request->phone,$request->email,$request->site_address,$request->map);
            }else{
                $contact_section_add = $this->contact_add($section->id,$request->address,$request->phone,$request->email,$request->site_address,$request->event_id,$request->map); 
            }
        }elseif($request->section_type == 'disclaimer_text'){
            if($request->id){
                $footer_section = $this->footer($request->id,$request->disclaimer_text);
            }else{
                $footer_section = $this->footer_add($section->id,$request->disclaimer_text,$request->event_id);
            }
        }
        return response()->json(['success'=>'successfully update section']);

    }

    public function text_editor($section_id,$text_editor_text){
        $text_editor = Event_Meta::where('section_id',$section_id)->first();
        $text_editor->text_editor = $text_editor_text;
        $text_editor->update();
        return true;
    }
    public function text_editor_update($section_id,$text,$event_id){
        $text_editor = new Event_Meta;
        $text_editor->text_editor = $text;
        $text_editor->event_id = $event_id;
        $text_editor->section_id = $section_id;
        $text_editor->save();
        return true;
    }
    public function right_image($section_id,$caption,$description,$image_name){
        $right_image_section = Event_Meta::where('section_id',$section_id)->first();
        if($image_name != null){
            $right_image_section->right_image_with_left_text_image = $image_name;
        }
        $right_image_section->right_image_with_left_text_caption = $caption;
        $right_image_section->right_image_with_left_text_description = $description;
        $right_image_section->update();
        return true;
    }
    public function right_image_update($section_id,$caption,$description,$image_name,$event_id){
        $right_image_section = new Event_Meta;
        if($image_name != null){
            $right_image_section->right_image_with_left_text_image = $image_name;
        }else{
            $right_image_section->right_image_with_left_text_image = '123.jpeg';
        }
        $right_image_section->right_image_with_left_text_caption = $caption;
        $right_image_section->right_image_with_left_text_description = $description;
        $right_image_section->section_id = $section_id;
        $right_image_section->event_id = $event_id;
        $right_image_section->save();
        return true;
    }
    public function left_image($section_id,$caption,$description,$image_name){
        $left_image_section = Event_Meta::where('section_id',$section_id)->first();
        if($image_name != null){
            $left_image_section->left_image_with_right_text_image = $image_name;
        }
        $left_image_section->left_image_with_right_text_caption = $caption;
        $left_image_section->left_image_with_right_text_description = $description;
        $left_image_section->update();
        return true;

    }
    public function left_image_add($section_id,$caption,$description,$image_name,$event_id){
        $left_image_section = new Event_Meta;
        if($image_name != null){
            $left_image_section->left_image_with_right_text_image = $image_name;
        }else{
            $left_image_section->left_image_with_right_text_image = '123.jpeg';
        }
        $left_image_section->left_image_with_right_text_caption = $caption;
        $left_image_section->left_image_with_right_text_description = $description;
        $left_image_section->event_id = $event_id;
        $left_image_section->section_id = $section_id;
        $left_image_section->save();
        return true;
    }
    public function gallery($section_id,$images){
      $gallery = Event_Meta::where('section_id',$section_id)->first();
      $oldimages = json_decode($gallery->gallery_section_images);
      $newimages = array_merge($oldimages,$images);
      $gallery->gallery_section_images = json_encode($newimages);
      $gallery->update();
      return true;
    }
    public function gallery_add($section_id,$images,$event_id){
        $gallery = new Event_Meta;
        $gallery->gallery_section_images = json_encode($images);
        $gallery->event_id = $event_id;
        $gallery->section_id = $section_id;
        $gallery->save();
        return true;
    }
    public function contact($section_id,$address,$phone,$email,$site_address,$map){
        $contact_section1 = Event_Meta::where('section_id',$section_id)->first();
        $contact_section1->contact_section_address = $address;
        $contact_section1->contact_section_contact = $phone;
        $contact_section1->contact_section_email = $email;
        $contact_section1->contact_section_site_address = $site_address;
        $contact_section1->map_status = $map;
        $contact_section1->save();
        return true;

    }
    public function contact_add($section_id,$address,$phone,$email,$site_address,$event_id,$map){
        $contact_section1 = new Event_Meta;
        $contact_section1->contact_section_address = $address;
        $contact_section1->contact_section_contact = $phone;
        $contact_section1->contact_section_email = $email;
        $contact_section1->contact_section_site_address = $site_address;
        $contact_section1->event_id = $event_id;
        $contact_section1->section_id = $section_id;
        $contact_section1->map_status = $map;
        $contact_section1->save();
        return true;
    }
    public function footer($section_id,$disclamier_Text){
        $disclamier_Text1 = Event_Meta::where('section_id',$section_id)->first();
        $disclamier_Text1->footer_disclaimer = $disclamier_Text;
        $disclamier_Text1->update();
        return true;
    }
    public function footer_add($section_id,$disclamier_Text,$event_id){
        $disclamier_Text1 = new Event_Meta;
        $disclamier_Text1->footer_disclaimer = $disclamier_Text;
        $disclamier_Text1->event_id = $event_id;
        $disclamier_Text1->section_id = $section_id;
        $disclamier_Text1->save();
        return true;
    }
    public function removeimage(Request $request){
        // return $request->all();
        $imagedata = Event_Meta::where('section_id',$request->sectionid)->whereJsonContains('gallery_section_images',$request->imagename)->first();
        $images = json_decode($imagedata->gallery_section_images);
        $key = array_search($request->imagename,$images);
        unset($images[$key]);
        foreach($images as $i){
            $imageoriginal[] = $i; 
        }
        $imagedata->gallery_section_images = json_encode($imageoriginal);
        $imagedata->update();
        return response()->json('successfully deleted images');
    }
    public function updatesectionnumber(Request $request){

        $currentsection = Section::find($request->sectionid);
        $prevsection = Section::where([['event_id',$currentsection->event_id],['section_number',$currentsection->section_number-1]])->first();
        if($prevsection){
            $prevsection->section_number = $prevsection->section_number+1;
            $prevsection->update();
        }
        $currentsection->section_number = $currentsection->section_number-1;
        $currentsection->update();
        return response()->json('successfully updated');
    }
}

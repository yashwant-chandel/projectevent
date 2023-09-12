@extends('admin_layout/index')
@section('content')
<style>
    .ck{
        height:300px
    }
</style>
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />


<form action="{{ url('/admin-dashboard/events/update') }}" method="post" class="eventform pb-5" id="eventform" enctype="multipart/form-data">
@csrf
<input type="hidden" name ="id" value="{{ $event->id ?? '' }}">
<?php $section_number = count($section)+1; ?>
                                <div class="nk-block nk-block-lg">
                                    <div class="d-flex justify-content-between">
                                        <h4>Add Event</h4>
                                        {{ Breadcrumbs::render('edit',$rsvp) }}
                                    </div>
                                        <div class="card card-bordered card-preview p-4">
                                      
                                            <div class="row gy-4">
                                             <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Event Title</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="default-01" name="title" placeholder="Event Title" onkeyup="convertToSlug(this.value)" value="{{ $event->title ?? '' }}">
                                                    <input type="file" id="imageInput" name="file" class="d-none"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Event Code</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="rsvp_code" name="rsvp_code" placeholder="Event Code" value="{{ $event->rsvp_code ?? '' }}">
                                                    @if ($errors->has('rsvp_code'))
                                                        <span class="text-danger">{{ $errors->first('rsvp_code') }}</span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Background image</label>
                                                    <div class="form-control-wrap">
                                                        <input type="file" class="form-control" id="background_image" name="background_image">
                                                     </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Event Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea name="subtitle" id="editor" cols="30" rows="10">{{ $event->sub_title ?? '' }}</textarea>
                                                     </div>
                                                </div>
                                               
                                                
                                        </div>
                                            <div class="col-lg-4 ">
                                                <div class="image">
                                                <img src="{{ asset($event->logo_path) }}" alt="" class="mt-4" >
                                                </div>
                                                <div class="form-group ">
                                                    <label class="form-label" for="default"> Upload Logo</label>
                                                    <div class="cropper-div" >
                                                        <div id="image-cropper" style="border:1px solid #ccc; margin: 5px;"><span class="upload_icon"><i class="fas fa-cloud-upload-alt"></i></span></div>
                                                        <button type="button" id="cropbutton" class="btn btn-sm btn-success">crop</button>
                                                        
                                                    </div>
                                                    <div class="d-none"> 
                                                        <div class="image-viewer"></div>
                                                        <button type="button" class="btn btn-success btn-sm mt-1" id="editbutton">edit</button>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            </div>
                                            <div class="col-2 mt-3">
                                            <button class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
</form>
                                <!-- .card-preview -->
                                <!-- <div id="multiple-session mx-4"> -->
                                <form action="{{ url('/admin-dashboard/events/sectionupdate') }}" method="post" class="eventform pb-5" id="eventform" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $event->id ?? '' }}">
                                    <div class="nk-block nk-block-lg">
                                            <div class="card card-bordered card-preview p-4">
                                                <div class="row">
                                                        <div class="col-lg-6" >
                                                            <div class="form-group">
                                                                    <label class="form-label">Event Type</label>
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2" name="session_type" id="select-events">
                                                                            <option value="Please select">Please Select</option>
                                                                            <option value="single" @if($event->session_type == 'multiple') selected @endif>Single</option>
                                                                            <option value="multiple" @if($event->session_type == 'multiple') selected @endif>Multiple</option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 d-none mt-4">
                                                                <button type="button" class="btn btn-primary btn-md" id="addsession">Add Session</button>
                                                        </div>
                                                        <hr class="mt-2">
                                                        <div class="row mt-2" id="multiple_session_div">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="session_start_date">Start date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="multisession_start_date" class="form-control" id="session_start_date" value="{{ $event->session['start_date'] ?? '' }}">
                                                                        </div> 
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="form-label" for="session_close_date">Close Date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="multisession_close_date" class="form-control" id="session_close_date" value="{{ $event->session['close_date'] ?? '' }}">
                                                                        </div> 
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="note">Description</label>
                                                                    <div class="form-control-wrap">
                                                                    <textarea class="form-control" name="multisesion_note" id="note1">{{ $event->session['note'] ?? '' }}</textarea>
                                                                    </div> 
                                                            </div>
                                                        </div>
                                                        
                                                        </div>
                                                        </div>
                                                            <div class="row p-2" id="session_outer_div">
                                                                <?php $num = 1; ?>
                                                                @foreach($subsession as $session)
                                                                    <div class="d-flex justify-content-between"><h4>Session {{ $num++ }}</h4><span class="remove_session" session-id="{{ url('/admin-dashboard/events/sessiondelete/'.$session->id) }}"><i class="fas fa-times"></i></span></div><div class="col-lg-6 p-1"><input type="hidden" name="session_id[]" value="{{ $session->id ?? '' }}"><div class="form-group"><label class="form-label" for="default-02">Start date</label><div class="form-control-wrap"><input type="date" name="session_start_sub_date[]" id="session_start_date" class="form-control" value="{{ $session->start_date ?? '' }}"></div></div><div class="form-group"><label class="form-label" for="default-02">Start time</label><div class="form-control-wrap"><input type="time" name="session_start_sub_time[]" id="session_start_time" class="form-control" value="{{ $session['start_time'] ?? '' }}"></div></div></div><div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Place</label><div class="form-control-wrap"><input type="text" name="session_sub_place[]" id="session_place" class="form-control" value="{{ $session['place'] }}"></div></div></div><hr class="mt-1">
                                                                @endforeach
                                                            </div>
                                                            <div class="session_div row mt-4">
                                                                <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_start_date">Start date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="singlesession_start_date" class="form-control" id="session_start_date" value="{{ $event->session['start_date'] ?? '' }}">
                                                                        </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_start_time">Start time</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="time" name="singlesession_start_time" class="form-control" id="session_start_time" value="{{ $event->session['start_time'] ?? '' }}">
                                                                        </div> 
                                                                </div>
                                                               
                                                                </div>
                                                                <div class="col-lg-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_close_date">Close Date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="singlesession_close_date" class="form-control" id="session_close_date" value="{{ $event->session['close_date'] ?? '' }}">
                                                                        </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_place">Place</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" name="singlesession_place" class="form-control" id="session_place" value="{{ $event->session['place'] ?? '' }}">
                                                                        </div> 
                                                                </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="note">Note</label>
                                                                    <div class="form-control-wrap">
                                                                    <textarea class="form-control" name="singlesession_note" id="note2">{{ $event->session['note'] ?? '' }}</textarea>
                                                                    </div> 
                                                                </div>
                                                             </div>
                                                             <button type="submit" class="btn btn-primary col-1 mt-3">Update</button>
                                                </div>
                                    </div>
                            </form>
                                    <div class="nk-block nk-block-lg">
                                            <div class="card card-bordered card-preview p-4 text-center">
                                                <div class="col-lg-12">
                                                <h2 class="text-center"> Event Details </h2>
                                                <button type="button" class="btn btn-info btn-lg" id="modal-button">Add New Content Section</button>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="section_div py-4">
                                        <?php $num = 0; 
                                        $counting = 1000;
                                        $x = 2000;
                                        $i = 0;
                                        ?>
                                        @foreach($section as $section)
                                        <?php $i++; ?>
                                        <form action="{{ url('admin-dashboard/section/update') }}" method="post" class="eventupdateform" id="eventform" enctype="multipart/form-data">
                                        @csrf   
                                        @if($section->section_name == "text-editor-section")
                                           
                                            <div class="nk-block nk-block-lg py-4"><div class="card card-bordered card-preview p-4 editor-section"><div class="card-header d-flex justify-content-between"><h4 class="text-center">Text Editor Section</h4><div><button type="button" section-name="text_editor" link="{{ url('/admin-dashboard/section/delete/'.$section->id) }}" class="btn btn-link close_section_db"><i class="fas fa-times"></i></button>@if($i != 1)<a class="increasesection" section-id="{{ $section->id ?? '' }}" href=""><i class="fas fa-arrow-up"></i></a>@endif</div></div><div class="form-group"><input type="hidden" name="section_type" value="{{ $section->section_name ?? '' }}"><input type="hidden" name="section_number" value="{{ $section->section_number ?? '' }}"><input type="hidden" name="id" value="{{ $section->id ?? '' }}"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control forminput" name="title" id="default-textarea-title" value="{{ $section->title ?? '' }}"></div></div><div class="form-group"><label class="form-label" for="editor-text-section">Text Editor</label><div class="form-control-wrap"><textarea class="form-control forminput" data-id="{{ $section->event_data['id'] ?? '' }}" name="text_editor_text" id="editor-text-section{{ $num }}">{{ $section->event_data['text_editor'] ?? '' }}</textarea></div></div><button type="submit" class="btn btn-primary col-lg-1 col-sm-2">Update</button></div></div>
                                           <script>
                                             ClassicEditor.create( document.querySelector( '#editor-text-section{{ $num }}' ) );
                                           </script>
                                            @elseif($section->section_name == "right-image-section")
                                            <?php  
                                            $counting = $counting+1;
                                            ?>
                                            <div class="nk-block nk-block-lg py-4"><div class="card card-bordered card-preview p-4 right-image-section"><div class="card-header d-flex justify-content-between"><h4>Right Image with left text</h4><div><button type="button" section-name="right_img_section" link="{{ url('/admin-dashboard/section/delete/'.$section->id) }}" class="btn btn-link close_section_db"><i class="fas fa-times"></i></button>@if($i != 1)<a class="increasesection" section-id="{{ $section->id ?? '' }}" href=""><i class="fas fa-arrow-up"></i></a>@endif</div></div><div class="form-group"><input type="hidden" name="section_type" value="{{ $section->section_name ?? '' }}"><input type="hidden" name="section_number" value="{{ $section->section_number ?? '' }}"><input type="hidden" name="id" value="{{ $section->id ?? '' }}"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="right-section-title" value="{{ $section->title ?? '' }}"></div></div><hr><div class="card-header"><h6>Right Image section</h6></div><div class="row"><div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Image</label><div class="form-control-wrap"><input type="file" name="right_section_image" class="form-control"></div></div></div><div class="col-lg-6"><img src="{{ url('/image/'.$section->event_data['right_image_with_left_text_image']) }}" alt=""></div></div><div class="form-group"><label class="form-label" for="default-02">Caption</label><div class="form-control-wrap"><textarea class="form-control forminput" name="right_section_caption" id="editor-text-section{{ $num }}">{{ $section->event_data['right_image_with_left_text_caption'] ?? '' }}</textarea></div></div><div class="form-group "><hr><div class="card-header col-lg-12"><h6>Left Description Section</h6></div><label class="form-label" for="editor-right-sction">Description</label><div class="form-control-wrap"><textarea style="height:400px" class="form-control" name="right_section_description" id="editor-text-section{{ $counting }}">{{ $section->event_data['right_image_with_left_text_description'] ?? '' }}</textarea></div></div><button type="submit" class="btn btn-primary col-lg-1 col-sm-2 ">Update</button></div></div>
                                            <script>
                                                 ClassicEditor.create( document.querySelector( '#editor-text-section{{ $num }}' ) );
                                                 ClassicEditor.create( document.querySelector( '#editor-text-section{{ $counting }}' ) );
                                            </script>
                                            @elseif($section->section_name == "left-image-section")
                                           
                                            <div class="nk-block nk-block-lg py-4"><div class="card card-bordered card-preview p-4 left-image-section"><div class="card-header d-flex justify-content-between"><h4>Left Image with Right text</h4><div><button type="button" section-name="left_img_section" link="{{ url('/admin-dashboard/section/delete/'.$section->id) }}" class="btn btn-link close_section_db"><i class="fas fa-times"></i></button>@if($i != 1)<a class="increasesection" section-id="{{ $section->id ?? '' }}" href=""><i class="fas fa-arrow-up"></i></a>@endif</div></div><div class="form-group"><input type="hidden" name="section_type" value="{{ $section->section_name ?? '' }}"><input type="hidden" name="section_number" value="{{ $section->section_number ?? '' }}"><input type="hidden" name="id" value="{{ $section->id ?? '' }}"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="left-section-title" value="{{ $section->title ?? '' }}"></div></div><hr><div class="card-header"><h6>Right Image section</h6></div><div class="row"><div class="col-lg-6"><div class="form-group><label class="form-label" for="default-02">Image</label><div class="form-control-wrap"> <input type="file" name="left_section_image" class="form-control" ></div></div></div><div class="col-lg-6"><img src="{{ url('/image/'.$section->event_data['left_image_with_right_text_image']) }}" alt=""></div></div><div class="form-group "><label class="form-label" for="default-02">Caption</label><div class="form-control-wrap"><textarea class="form-control" name="left_section_caption" id="editor-text-section{{ $num }}">{{ $section->event_data['left_image_with_right_text_caption'] ?? '' }}</textarea></div></div><hr><div class="card-header col-lg-12"><h6>Left Description Section</h6></div><div class="form-group "><label class="form-label" for="editor-left-section">Description</label><div class="form-control-wrap"><textarea class="form-control" name="left_section_description" id="editor-text-section{{ $counting }}">{{ $section->event_data['left_image_with_right_text_description'] ?? '' }}</textarea></div></div><button type="submit" class="btn btn-primary col-lg-1 col-sm-2">Update</button></div></div>
                                            <script>
                                                 ClassicEditor.create( document.querySelector( '#editor-text-section{{ $num }}' ) );
                                                 ClassicEditor.create( document.querySelector( '#editor-text-section{{ $counting }}' ) );
                                            </script>
                                            @elseif($section->section_name == "gallery-section")
                                            
                                            <div class="nk-block nk-block-lg py-4"><div class="card card-bordered card-preview p-4 gallery-section"><div class="card-header d-flex justify-content-between"><h4>Gallery Section</h4><div><button type="button" section-name="gallery_section" link="{{ url('/admin-dashboard/section/delete/'.$section->id) }}" class="btn btn-link close_section_db"><i class="fas fa-times"></i></button>@if($i != 1)<a class="increasesection" section-id="{{ $section->id ?? '' }}" href=""><i class="fas fa-arrow-up"></i></a>@endif</div></div><div class="col-lg-6"><div class="form-group"><input type="hidden" name="section_type" value="{{ $section->section_name ?? '' }}"><input type="hidden" name="section_number" value="{{ $section->section_number ?? '' }}"><input type="hidden" name="id" value="{{ $section->id ?? '' }}"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="gallery-section-title" value="{{ $section->title ?? '' }}"></div></div><div class="form-group "><div class="custom-file"><input type="hidden" name="images_count[]" id="images_count'+x+'" class="images_count"><input type="file" class="custom-file-input" id="gallery_images{{ $x }}" name="gallery_images[]" multiple onchange="javascript:updateList()"><label class="custom-file-label" for="gallery_images"><img width="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAQlBMVEX///8AAABhYWFlZWWSkpL19fW9vb01NTXf398kJCTw8PBRUVGdnZ1dXV3m5uZ0dHR8fHzExMSMjIzU1NSxsbEhISGIc9b1AAADv0lEQVR4nO2d607jMBhEa1pa6AVaLu//qgixq2+XxmlSe+IZa85vazQjhZMCarJaGWOMMcYYc8WxdQE0m7RpXQHLNqW0bV0CyVP65ql1DRyP6YfH1kVg7P4s3LUugmKd/rJuXQXDJgVdCnWb/qVDoT6l/+lOqI/pN70JdXe1sDOhrq8GdibUzcDAroS6HRzYkVB/a7Q7oV5rtDehXms06EKoQxoNOhDqsEYDeaHmNBqICzWv0UBaqGMaDZSFOqbRQFio4xoNZIV6S6OBqFBvazSQFOoUjQaCQp2m0UBPqNM0GsgJdapGAzGhTtdoICXUORoNhIQ6T6OBjFDnajRQEepcjQYiQp2v0UBCqPdoNBAQ6n0aDeiFeq9GA3Kh3q/RgFuo92s0oBZqiUYDYqGWaTSgFWqpRgNSoZZrNKAUag2NBoxCraHRgFCodTQa0Am1lkYDMqHW02hAJdSaGg2IhFpXowGPUOtqNKARam2NBiRCra/RgEKoCI0GBELFaDRoLlSURoPWQkVpNGgsVJxGg6ZCRWo0aChUrEaDZkJFazRoJFS8RoM2QsVrNGgi1NOCA1M6LT9we3iYzPp5sPXzenrEgeDj2xjDt02S3xyq8DC48KF1rYp4oT5eqI8X6uOF+nihPl6ojxfq44X6eKE+XqiPF+rjhfp4oT5eqI8X6uOF+nihPl6ojxfq44X6eKE+XqiPF+rjhfp4oT5eqI8XLsVhsMehQjJu4bzOuB4sySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wybgew8/nq/EcPZaFb6eBx+id3ioksyzE4YUlpznwwpLTHHhhyWkOvLDkNAdeWHKaAy8sOc2BF5ac5sALS05z4IUlpznwwpLTHNRYyP2OhuH3SsxbOOc9G4uTeTdIbuESr6dahtx1d25drBrnzMJj62LVOGYWXloXq8Yls3Dfulg19pmFq8/WzSrxnBu40Kvw8ORftvfSulolXrILM99XVGPsO6HvrctV4X1k4cKvi8Mw/s/zHm4Y2VvFDx+t+xXzMT5wtXpt3bCQ11sD1X066bv1yhMnPjxA90KdcIn+oKqbm5IJ9or3xdON28Qv3tV+Gg+jn2QGedkM/5WHkc/NyIftMfaX45n5L23frM/Hy7zL0xhjjDHGEPIFcc477O4fZUsAAAAASUVORK5CYII=" /> Add Multiple images</label></div><ul id="fileList{{ $x }}" class="file-list"></ul></div></div><div class="col-lg-3 col-sm-6 d-flex justify-content-between"><button type="submit" class="btn btn-primary">Update</button><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDefault{{ $section->event_data['id'] }}">View Images</button></div></div></div>
                                            <?php $x = $x+1; ?>
                                            <div class="modal fade" tabindex="-1" id="modalDefault{{ $section->event_data['id'] }}">
                                                    <div class="modal-dialog modal-md" role="document">
                                                        <div class="modal-content">
                                                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <em class="icon ni ni-cross"></em>
                                                            </a>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $section->title ?? '' }} Images</h5>
                                                            </div>
                                                            <?php $images = json_decode($section->event_data['gallery_section_images']); ?>
                                                            <div class="modal-body">
                                                            <div class="nk-content ">
                                                                    <div class="container-fluid">
                                                                        <div class="nk-content-inner">
                                                                            <div class="nk-content-body">
                                                                                <div class="nk-block">
                                                                                    <div class="row g-gs">
                                                                                    @foreach($images as $image)
                                                                                        <div class="col-sm-6 col-lg-6 col-xxl-3 {{ $image ?? '' }}" id="{{ $image ?? '' }}">
                                                                                            <div class="gallery card card-bordered">
                                                                                                <a class="gallery-image popup-image" href="./images/stock/a.jpg">
                                                                                                    <img class="w-100 rounded-top" src="{{asset('/image/'.$image)}}" alt="">
                                                                                                </a>
                                                                                                <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                                                                <button class="btn btn-danger deleteimage" section-id ="{{ $section->id ?? '' }}" imagename = "{{$image ?? ''}}" >delete</button> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                    </div>
                                                                                </div><!-- .nk-block -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($section->section_name == "contact-section")
                                         
                                            <div class="nk-block nk-block-lg py-4"><div class="card card-bordered card-preview p-4 contact-section"><div class="card-header d-flex justify-content-between"><h4>Contact Section</h4><div><button type="button" section-name="contact_section" link="{{ url('/admin-dashboard/section/delete/'.$section->id) }}" class="btn btn-link close_section_db"><i class="fas fa-times"></i></button>@if($i != 1)<a class="increasesection" section-id="{{ $section->id ?? '' }}" href=""><i class="fas fa-arrow-up"></i></a>@endif</div></div><div class="row"><div class="col-lg-6"><div class="form-group"><input type="hidden" name="section_type" value="{{ $section->section_name ?? '' }}"><input type="hidden" name="section_number" value="{{ $section->section_number ?? '' }}"><input type="hidden" name="id" value="{{ $section->id ?? '' }}"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="contact-section-title" value="{{ $section->title ?? '' }}"></div></div><div class="form-group "><label class="form-label" for="default-02">Address</label><div class="form-control-wrap"><input type="text" name="address" class="form-control" value="{{ $section->event_data['contact_section_address'] ?? '' }}"></div></div><div class="form-group "><label class="form-label" for="default-02">Contact Number</label><div class="form-control-wrap"><input type="text" name="phone" class="form-control" value="{{ $section->event_data['contact_section_contact'] ?? '' }}"></div></div></div><div class="col-lg-6"><div class="form-group "><label class="form-label" for="default-02">Email</label><div class="form-control-wrap"><input type="email" name="email" class="form-control" value="{{ $section->event_data['contact_section_email'] ?? '' }}"></div></div><div class="form-group "><label class="form-label" for="default-02">Site Address</label><div class="form-control-wrap"><input type="text" name="site_address" class="form-control" value="{{ $section->event_data['contact_section_site_address'] ?? '' }}"></div></div><div class="custom-control custom-checkbox mt-4"><input type="checkbox" class="custom-control-input" name="map" id="customCheck1{{ $num }}" value="1" @if($section->event_data['map_status'] == 1) checked @endif><label class="custom-control-label" for="customCheck1{{ $num }}">Map</label></div></div></div><div class="py-4"><button type="submit" class="btn btn-primary col-lg-1 col-sm-2">Update</button></div></div></div>
                                            @elseif($section->section_name == "disclaimer_text")
                                            <?php ?>
                                            <div class="nk-block nk-block-lg py-4"><div class="card card-bordered card-preview p-4 footer-section"><div class="card-header d-flex justify-content-between"><h4>Footer Section</h4><div><button type="button" section-name="footer_section" link="{{ url('/admin-dashboard/section/delete/'.$section->id) }}" class="btn btn-link close_section_db"><i class="fas fa-times"></i></button>@if($i != 1)<a class="increasesection" section-id="{{ $section->id ?? '' }}" href=""><i class="fas fa-arrow-up"></i></a>@endif</div></div><div class="col-lg-12"><div class="form-group"><input type="hidden" name="section_type" value="{{ $section->section_name ?? '' }}"><input type="hidden" name="section_number" value="{{ $section->section_number ?? '' }}"><input type="hidden" name="id" value="{{ $section->id ?? '' }}"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="footer-section-title" value="{{ $section->title ?? '' }}"></div></div><div class="form-group "><label class="form-label" for="editor">Disclaimer</label><div class="form-control-wrap"><textarea class="form-control" name="disclaimer_text" id="editor-text-section{{ $num }}">{{ $section->event_data['footer_disclaimer'] ?? '' }}</textarea></div></div></div><div class="py-4"><button type="submit" class="btn btn-primary col-lg-1 col-sm-2">Update</button></div></div></div>
                                           <script>
                                             ClassicEditor.create( document.querySelector( '#editor-text-section{{ $num }}' ) );
                                           </script>
                                            @endif
                                            </form>
                                            <script>
                                               
                                               
                                                updateList = function() {
                                                    var input = document.getElementById('gallery_images{{ $x }}');
                                                    var output = document.getElementById('fileList{{ $x }}');
                                                    var children = "";
                                                    for (var i = 0; i < input.files.length; ++i) {
                                                        children +=  '<li>'+ input.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">X</span>' + '</li>'
                                                    }
                                                    output.innerHTML = children;
                                                }
                                          </script>
                                            <?php $num = $num+1;  ?>
                                            <?php 
                                            $counting = $counting+1;
                                            ?>
                                        @endforeach
                                    </div>
                                    <form action="{{ url('admin-dashboard/section/update') }}" method="post" class="eventupdateform" id="eventform" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="section_number" value="{{ $section_number ?? '' }}">
                                    <input type="hidden" name="event_id" value="{{ $event->id ?? '' }}">
                                    <div class="section_div1 py-4">
                                        
                                    </div>
                                    </form >
                               
                                <div class="nk-block nk-block-lg">
                                    
                                    
                                </div>
        <!-- </form> -->

<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="selectcontent">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Select Type Of Content</h5>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <div class="form-control-wrap">
                    <select class="form-select" id="section_select">
                        <option value="please select">Please Select</option>
                        <option value="text_editor">Text Editor</option>
                        <option value="right_img_section">Right image with left text</option>
                        <option value="left_img_section">Left image with Right text</option>
                        <option value="gallery_section">Gallery Section</option>
                        <option value="contact_section">Contact section</option>
                        <option value="footer_section">Footer Section</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary mt-2" id="add_section">Add</button>
            </div>
            </div>
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
@if($event->session_type == 'single')
      $('#multiple_session_div').hide(); 
      $('#addsession').parent().addClass('d-none')
@else
    $('.session_div').hide();
    $('#addsession').parent().removeClass('d-none')
@endif
    });
</script>
<script>
$('#add-learn-list').click(function(e){
    e.preventDefault();
    html ='<div class="form-group"><div class="form-control-wrap"><input type="text" class="form-control" name="learn_list[]" id="learn-list"></div></div>';
    
    // console.log('done');
    $('.learn-list-section').append(html);
});
</script>
 <script>
    ClassicEditor.create( document.querySelector( '#editor' ) );
    ClassicEditor.create( document.querySelector( '#note1' ) );
    ClassicEditor.create( document.querySelector( '#note2' ) );
    // ClassicEditor.create( document.querySelector( '#editor-text-section' ) );
</script> 


<script>
cropper(document.getElementById('image-cropper'), {
    area: [ 200, 200 ],
    crop: [ 100, 100 ],
})
 
$(document).ready(function(){
    $('#cropbutton').on('click',function(e){
        // e.preventDefault();
        url = document.getElementById('image-cropper').crop.getCroppedImage().src;
        $('#image-cropper').parent().hide();
        $('.image-viewer').parent().removeClass('d-none');
        $('.image-viewer').html('<img src="'+url+'" height="200px" width="200px">');

    //    console.log(url);
        var base64Image = url;
        $('#imagepath').val(url);
        // return false;
// Get the input type file element
            var imageInput = document.getElementById("imageInput");

            // Create a new File object from the base64 image

            var filename = "image.png";
            dataURL = base64Image;
            var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
                            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                        while (n--) {
                            u8arr[n] = bstr.charCodeAt(n);
            }
            var file = new File([u8arr], filename, { type: mime });
                    

            // Create a FileList object and set it as the input's files
            var fileList = new DataTransfer();
            fileList.items.add(file);
            imageInput.files = fileList.files;
            // $('#eventform').submit();
    })
})
$('#editbutton').click(function(){
    $(this).parent().addClass('d-none');
    $('#image-cropper').parent().show();

})

</script>  
<script>
    i = '{{ count($subsession); }}';
    $('#addsession').click(function(e){
        e.preventDefault();
        i++;
        html = '<h4>Session '+ i +'</h4><div class="col-lg-6 p-1" id="session'+i+'"><input type="hidden" name="session_id[]"><div class="form-group"><label class="form-label" for="default-02">Start date</label><div class="form-control-wrap"><input type="date" name="session_start_sub_date[]" id="session_start_date" class="form-control"></div></div><div class="form-group"><label class="form-label" for="default-02">Start time</label><div class="form-control-wrap"><input type="time" name="session_start_sub_time[]" id="session_start_time" class="form-control"></div></div></div><div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Place</label><div class="form-control-wrap"><input type="text" name="session_sub_place[]" id="session_place" class="form-control"></div></div></div><hr class="mt-1"></div>';
        // console.log(html);
        $('#session_outer_div').append(html);

        var targetDiv = $("#session"+i);
        var targetPosition = targetDiv.offset().top + targetDiv.height() / 2 - $(window).height() / 2;
        $('html, body').animate({
            scrollTop: targetPosition
        }, 0);
    })

    //removesession
    $("body").delegate('.remove_session','click',function(){
        link = $(this).attr('session-id');
        window.location.href = link;
    });
    // $("body").delegate('.removesession','click',function(){
    //     // console.log('done');
        

    // });
</script>   
<script>
    $(document).ready(function(){
        // $('#multiple_session_div').hide();
        // $('.session_div').hide();
        $("body").delegate("#select-events", "change", function (e) {
        //    console.log($(this).val());
            if($(this).val() === 'multiple'){
                
                // $('#session_close_date').val('');
                $('#session_outer_div').show();
                    $('.session_div').hide();
                    $('#addsession').parent().removeClass('d-none');
                    $('#multiple_session_div').show();
            }else{
                $('#session_outer_div').hide();
                    $('.session_div').show();
                    $('#addsession').parent().addClass('d-none')
                    $('#multiple_session_div').hide();
            }
        });
    });
</script>   
        <!-- <script>
            updateList = function() {
            var input = document.getElementById('gallery_images');
            var output = document.getElementById('fileList');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children +=  '<li>'+ input.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">X</span>' + '</li>'
            }
            output.innerHTML = children;
        }
  </script>      -->
  <script>
    $(document).ready(function(){
        num = 0;
    $('#modal-button').click(function(){
        $('#selectcontent').modal("show");
    });
    $("body").delegate("#add_section","click",function(e){
        let x = Math.floor((Math.random() * 10000) + 1);
        text_editor = '<div class="nk-block nk-block-lg" id="sectionnumber'+x+'"><div class="card card-bordered card-preview p-4 editor-section"><div class="card-header d-flex justify-content-between"><h4 class="text-center">Text Editor Section</h4><button type="button" section-name="text_editor" class="btn btn-link close_section"><i class="fas fa-times"></i></button></div><div class="form-group"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="default-textarea-title"></div></div><div class="form-group"><label class="form-label" for="editor-text-section">Text Editor</label><div class="form-control-wrap"><textarea class="form-control" name="text_editor_text" id="editor-text-section'+x+'"></textarea></div><button type="submit" class="btn btn-primary mt-2" id="submitbutton">submit</button></div></div></div>';
        right_img_section = '<div class="nk-block nk-block-lg " id="sectionnumber'+x+'"><div class="card card-bordered card-preview p-4 right-image-section"><div class="card-header d-flex justify-content-between"><h4>Right Image with left text</h4><button type="button" section-name="right_img_section" class="btn btn-link close_section"><i class="fas fa-times"></i></button></div><div class="form-group"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="right-section-title"></div></div><hr><div class="card-header"><h6>Right Image section</h6></div> <div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Image</label><div class="form-control-wrap"><input type="file" name="right_section_image" class="form-control"></div></div></div><div class="form-group"><label class="form-label" for="default-02">Caption</label><div class="form-control-wrap"><textarea class="form-control" name="right_section_caption" id="editor-text-section'+x+'"></textarea></div></div><div class="form-group "><hr><div class="card-header col-lg-12"><h6>Left Description Section</h6></div><label class="form-label" for="editor-right-sction">Description</label><div class="form-control-wrap"><textarea style="height:400px" class="form-control" name="right_section_description" id="editor-text-section1'+x+'"></textarea></div><button type="submit" class="btn btn-primary mt-2" id="submitbutton">submit</button></div></div></div>';
        left_img_section = '<div class="nk-block nk-block-lg " id="sectionnumber'+x+'"><div class="card card-bordered card-preview p-4 left-image-section"><div class="card-header d-flex justify-content-between"><h4>Left Image with Right text</h4><button type="button" section-name="left_img_section" class="btn btn-link close_section"><i class="fas fa-times"></i></button></div><div class="form-group"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="left-section-title"></div></div><hr><div class="card-header"><h6>Right Image section</h6></div><div class="col-lg-6"><div class="form-group><label class="form-label" for="default-02">Image</label><div class="form-control-wrap"> <input type="file" name="left_section_image" class="form-control"></div></div></div><div class="form-group "><label class="form-label" for="default-02">Caption</label><div class="form-control-wrap"><textarea class="form-control" name="left_section_caption" id="editor-text-section'+x+'"></textarea></div></div><hr><div class="card-header col-lg-12"><h6>Left Description Section</h6></div><div class="form-group "><label class="form-label" for="editor-left-section">Description</label><div class="form-control-wrap"><textarea class="form-control" name="left_section_description" id="editor-text-section1'+x+'"></textarea></div><button type="submit" class="btn btn-primary mt-2" id="submitbutton">submit</button></div></div></div>';
        gallery_section = '<div class="nk-block nk-block-lg " id="sectionnumber'+x+'"><div class="card card-bordered card-preview p-4 gallery-section"><div class="card-header d-flex justify-content-between"><h4>Gallery Section</h4><button type="button" section-name="gallery_section" class="btn btn-link close_section"><i class="fas fa-times"></i></button></div><div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="gallery-section-title"></div></div><div class="form-group "><div class="custom-file"><input type="hidden" name="images_count[]" id="images_count'+x+'" class="images_count"><input type="file" class="custom-file-input" id="gallery_images'+x+'" name="gallery_images[]" multiple ><label class="custom-file-label" for="gallery_images"><img width="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAQlBMVEX///8AAABhYWFlZWWSkpL19fW9vb01NTXf398kJCTw8PBRUVGdnZ1dXV3m5uZ0dHR8fHzExMSMjIzU1NSxsbEhISGIc9b1AAADv0lEQVR4nO2d607jMBhEa1pa6AVaLu//qgixq2+XxmlSe+IZa85vazQjhZMCarJaGWOMMcYYc8WxdQE0m7RpXQHLNqW0bV0CyVP65ql1DRyP6YfH1kVg7P4s3LUugmKd/rJuXQXDJgVdCnWb/qVDoT6l/+lOqI/pN70JdXe1sDOhrq8GdibUzcDAroS6HRzYkVB/a7Q7oV5rtDehXms06EKoQxoNOhDqsEYDeaHmNBqICzWv0UBaqGMaDZSFOqbRQFio4xoNZIV6S6OBqFBvazSQFOoUjQaCQp2m0UBPqNM0GsgJdapGAzGhTtdoICXUORoNhIQ6T6OBjFDnajRQEepcjQYiQp2v0UBCqPdoNBAQ6n0aDeiFeq9GA3Kh3q/RgFuo92s0oBZqiUYDYqGWaTSgFWqpRgNSoZZrNKAUag2NBoxCraHRgFCodTQa0Am1lkYDMqHW02hAJdSaGg2IhFpXowGPUOtqNKARam2NBiRCra/RgEKoCI0GBELFaDRoLlSURoPWQkVpNGgsVJxGg6ZCRWo0aChUrEaDZkJFazRoJFS8RoM2QsVrNGgi1NOCA1M6LT9we3iYzPp5sPXzenrEgeDj2xjDt02S3xyq8DC48KF1rYp4oT5eqI8X6uOF+nihPl6ojxfq44X6eKE+XqiPF+rjhfp4oT5eqI8X6uOF+nihPl6ojxfq44X6eKE+XqiPF+rjhfp4oT5eqI8XLsVhsMehQjJu4bzOuB4sySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wybgew8/nq/EcPZaFb6eBx+id3ioksyzE4YUlpznwwpLTHHhhyWkOvLDkNAdeWHKaAy8sOc2BF5ac5sALS05z4IUlpznwwpLTHNRYyP2OhuH3SsxbOOc9G4uTeTdIbuESr6dahtx1d25drBrnzMJj62LVOGYWXloXq8Yls3Dfulg19pmFq8/WzSrxnBu40Kvw8ORftvfSulolXrILM99XVGPsO6HvrctV4X1k4cKvi8Mw/s/zHm4Y2VvFDx+t+xXzMT5wtXpt3bCQ11sD1X066bv1yhMnPjxA90KdcIn+oKqbm5IJ9or3xdON28Qv3tV+Gg+jn2QGedkM/5WHkc/NyIftMfaX45n5L23frM/Hy7zL0xhjjDHGEPIFcc477O4fZUsAAAAASUVORK5CYII=" /> Add Multiple images</label></div><ul id="fileList'+x+'" class="file-list"></ul></div><button type="submit" class="btn btn-primary mt-2" id="submitbutton">submit</button></div></div></div>';
        Contact_Section = '<div class="nk-block nk-block-lg " id="sectionnumber'+x+'"><div class="card card-bordered card-preview p-4 contact-section"><div class="card-header d-flex justify-content-between"><h4>Contact Section</h4><button type="button" section-name="contact_section" class="btn btn-link close_section"><i class="fas fa-times"></i></button></div><div class="row"><div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="contact-section-title"></div></div><div class="form-group "><label class="form-label" for="default-02">Address</label><div class="form-control-wrap"><input type="text" name="address" class="form-control"></div></div><div class="form-group "><label class="form-label" for="default-02">Contact Number</label><div class="form-control-wrap"><input type="text" name="phone" class="form-control"></div></div></div><div class="col-lg-6"><div class="form-group "><label class="form-label" for="default-02">Email</label><div class="form-control-wrap"><input type="email" name="email" class="form-control"></div></div><div class="form-group "><label class="form-label" for="default-02">Site Address</label><div class="form-control-wrap"><input type="text" name="site_address" class="form-control"></div></div><div class="custom-control custom-checkbox mt-4"><input type="checkbox" class="custom-control-input" name="map" value="1" id="customCheck1"><label class="custom-control-label" for="customCheck1">Map</label></div></div></div><div class="col-1"><button type="submit" class="btn btn-primary mt-2" id="submitbutton">submit</button></div></div></div>';
        footer_section = '<div class="nk-block nk-block-lg " id="sectionnumber'+x+'"><div class="card card-bordered card-preview p-4 footer-section"><div class="card-header d-flex justify-content-between"><h4>Footer Section</h4><button type="button" section-name="footer_section" class="btn btn-link close_section"><i class="fas fa-times"></i></button></div><div class="col-lg-12"><div class="form-group"><label class="form-label" for="default-02">Title</label><div class="form-control-wrap"><input class="form-control" name="title" id="footer-section-title"></div></div><div class="form-group "><label class="form-label" for="editor">Disclaimer</label><div class="form-control-wrap"><textarea class="form-control" name="disclaimer_text" id="editor-text-section'+x+'"></textarea></div></div><button type="submit" class="btn btn-primary mt-2" id="submitbutton">submit</button></div></div></div>';
    
        
        $(this).hide();
        $('#selectcontent').modal("hide");
        // window.scrollBy(0, 100000000000);
            selectval = $('#section_select').val();
            if(selectval == 'text_editor'){
                // $('#section_select').children('option[value="text_editor"]').attr('disabled','');
              $('.section_div1').append('<div>'+text_editor+'<input type="hidden" name="section_type" value="text-editor-section"></div>');
           
            }else if(selectval == 'right_img_section'){
                // $('#section_select').children('option[value="right_img_section"]').attr('disabled','');
                $('.section_div1').append('<div>'+right_img_section+'<input type="hidden" name="section_type" value="right-image-section"></div></div>');
            }else if(selectval == 'left_img_section'){
                // $('#section_select').children('option[value="left_img_section"]').attr('disabled','');
                $('.section_div1').append('<div>'+left_img_section+'<input type="hidden" name="section_type" value="left-image-section"></div>');
            }else if(selectval == 'gallery_section'){
                // $('#section_select').children('option[value="gallery_section"]').attr('disabled','');
                $('.section_div1').append('<div>'+gallery_section+'<input type="hidden" name="section_type" value="gallery-section"></div></div>');
            var targetDiv = $("#sectionnumber"+x);
            $('html, body').animate({
                scrollTop: targetDiv.offset().top
            }, 0);
                return true;
            }else if(selectval == 'contact_section'){
                // $('#section_select').children('option[value="contact_section"]').attr('disabled','');
                $('.section_div1').append('<div>'+Contact_Section+'<input type="hidden" name="section_type" value="contact-section"></div></div>');
            var targetDiv = $("#sectionnumber"+x);
            $('html, body').animate({
                scrollTop: targetDiv.offset().top
            }, 0);
                return true;
            }else if(selectval == 'footer_section'){
                // $('#section_select').children('option[value="footer_section"]').attr('disabled','');
                $('.section_div1').append('<div>'+footer_section+'<input type="hidden" name="section_type" value="disclaimer_text"></div></div>');
                
            }
            //scroll code 
            var targetDiv = $("#sectionnumber"+x);
            $('html, body').animate({
                scrollTop: targetDiv.offset().top
            }, 0);

            // editor code
            const editorId = 'editor-text-section'+x;
             const editor =  ClassicEditor
            .create(document.querySelector(`#${editorId}`))
            .then(editor => {
               
                // console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
            
           
            const editorId1 = 'editor-text-section1'+x;
            const editor1 =  ClassicEditor
            .create(document.querySelector(`#${editorId1}`))
            .then(editor1 => {
                // console.log(editor1);
            })
            .catch(error => {
                console.error(error);
            });


         
        //     updateList = function() {
        //     var input = document.getElementById('gallery_images'+x);
        //     var output = document.getElementById('fileList'+x);
        //     var children = "";
        //     for (var i = 0; i < input.files.length; ++i) {
        //         children +=  '<li>'+ input.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">X</span>' + '</li>'
        //     }
        //     output.innerHTML = children;
        // }
    
 
            
        })
        $("body").delegate(".close_section","click",function(e){
            section_name = $(this).attr('section-name');
            $('#section_select').children('option[value="'+section_name+'"]').removeAttr('disabled');
            main_div = $(this).parent().parent().parent().parent();
            $('#add_section').show();
            section_val = main_div.children('input[name="sections[]"]').val('');
            // console.log(section_val);
            $(this).parent().parent().parent().remove();

        })
    })
    $("body").delegate(".custom-file-input","change",function(e){
        fileCount = this.files.length;
        input = $(this).closest("div").find("input.images_count");
        input.val(fileCount);
    $('.remove-list').click(function(){
        fileCount = fileCount-1;
        input.val(fileCount);
    });
})
  </script>  
  <script>
    $("body").delegate(".forminput","keyup",function(e){
        console.log('done');
    })
    // $('.forminput').change(function(){
    //     console.log('done');
    // })
  </script>

  <script>
    $('.close_section_db').click(function(){
        link = $(this).attr('link');
        Swal.fire({
        title: 'Do you want to delete this section?',
        showCancelButton: true,
        confirmButtonText: 'yes',
        confirmButtonColor: '#008000',
        cancelButtonText: 'no',
        cancelButtonColor: '#d33',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        } 
        }); 

    });


    $("body").delegate(".eventupdateform","submit",function(e){
        e.preventDefault();
        formdata = new FormData(this);
        $.ajax({
         method: 'post',
         url: '{{ url('admin-dashboard/section/update') }}',
         data: formdata,
         dataType: 'json',
         contentType: false,
         processData: false,
         success: function(response)
         {
            NioApp.Toast(response.success, 'info', {position: 'top-right'});
            setTimeout(function() {
                    location.reload();
                }, 1000);
         }
        })

    })
   
  </script>
  <script>
    // $('.deleteimage').click(function(e){
    $("body").delegate(".deleteimage","click",function(e){
        e.preventDefault();
        sectionid = $(this).attr('section-id');
        imagename = $(this).attr('imagename');
        
        $.ajax({
        method: 'post',
        url: '{{ url('/admin-dashboard/section/removeimage/') }}',
        data: { sectionid:sectionid,imagename:imagename,_token:'{{ csrf_token() }}' },
        success:function(response){
            NioApp.Toast(response, 'info', {position: 'top-right'});
            setTimeout(function() {
                    location.reload();
                }, 1000);
            
        }
        })

    })
  </script>
  <!-- increase section number -->
  <script>
$(document).ready(function(){
    $('.increasesection').on('click',function(e){
        e.preventDefault();
        sectionid = $(this).attr('section-id');
        $.ajax({
        method: 'post',
        url: '{{ url('/admin-dashboard/section/updatesectionnumber/') }}',
        data: { sectionid:sectionid,_token:'{{ csrf_token() }}' },
        success:function(response){
            setTimeout(function() {
                    location.reload();
                }, 1000);
        }
    });
});
});
  </script>


    <script>
     function convertToSlug(str){
        console.log(str);
        str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                .toUpperCase();

        // trim spaces at start and end of string
        str = str.replace(/^\s+|\s+$/gm,'');
        // alert(str);
        // replace space with dash/hyphen
        str = str.replace(/\s+/g, '-');   
        // document.getElementById("slug-text").innerHTML = str;
            $('#rsvp_code').val(str);
    //return str;
  }
  </script>
        
@endsection
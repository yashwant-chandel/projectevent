@extends('admin_layout/index')
@section('content')
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />
<form action="{{ url('/admin-dashboard/events/save') }}" method="post" class="eventform" id="eventform" enctype="multipart/form-data">
                                                @csrf
                                <div class="nk-block nk-block-lg">
                                <h4>Add Event</h4>
                                        <div class="card card-bordered card-preview p-4">
                                      
                                            <div class="row gy-4">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Event Title</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="default-01" name="title" placeholder="Event Title">
                                                    <input type="file" id="imageInput" name="file" class="d-none"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Event Subtitle</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="default-01" name="subtitle" placeholder="Event Sub Title">
                                                     </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">Background image</label>
                                                    <div class="form-control-wrap">
                                                        <input type="file" class="form-control" id="background_image" name="background_image">
                                                     </div>
                                                </div>
                                                
                                        </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default"> Upload Icon</label>
                                                    <div class="cropper-div" >
                                                        <div id="image-cropper" style="border:1px solid #ccc; margin: 5px;"></div>
                                                        <button type="button" id="cropbutton" class="btn btn-sm btn-success">crop</button>
                                                        
                                                    </div>
                                                    <div class="d-none"> 
                                                        <div class="image-viewer"></div>
                                                        <button type="button" class="btn btn-success btn-sm mt-1" id="editbutton">edit</button>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- .card-preview -->
                                <!-- <div id="multiple-session mx-4"> -->
                                    <div class="nk-block nk-block-lg">
                                            <div class="card card-bordered card-preview p-4">
                                                <div class="row">
                                                        <div class="col-lg-6" >
                                                            <div class="form-group">
                                                                    <label class="form-label">Session Type</label>
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2" id="select-events">
                                                                            <option value="single">Single</option>
                                                                            <option value="mulitple">Multiple</option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            
                                                            <div class="col-lg-6 d-none">
                                                                <button type="button" class="btn btn-primary btn-md" id="addsession">Add Session</button>
                                                            </div>
                                                        </div>
                                                            <div class="row" id="session_outer_div">
                                                                <div class="col-lg-6">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="session_start_date">Start date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="session_start_date[]" class="form-control" id="session_start_date">
                                                                        </div> 
                                                            </div>
                                                            <div class="form-group">
                                                                    <label class="form-label" for="session_close_date">Close Date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="session_close_date[]" class="form-control" id="session_close_date">
                                                                        </div> 
                                                                </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="note">Note</label>
                                                                    <div class="form-control-wrap">
                                                                    <textarea class="form-control" name="note[]" id="note"></textarea>
                                                                    </div> 
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="session_div row mt-4">
                                                            <h4>Event Session Details</h4>
                                                                <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_start_date">Start date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="session_start_date[]" class="form-control" id="session_start_date">
                                                                        </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_start_time">Start time</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="time" name="session_start_time[]" class="form-control" id="session_start_time">
                                                                        </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_place">Place</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" name="session_place[]" class="form-control" id="session_place">
                                                                        </div> 
                                                                </div>
                                                                </div>
                                                                <div class="col-lg-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="session_close_date">Close Date</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="date" name="session_close_date[]" class="form-control" id="session_close_date">
                                                                        </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label" for="note">Note</label>
                                                                    <div class="form-control-wrap">
                                                                    <textarea class="form-control" name="note[]" id="note"></textarea>
                                                                    </div> 
                                                                </div>
                                                                </div>
                                                             </div>
                                                </div>
                                    </div>
                                    <div class="multiple-section py-4">

                                    </div>
                                <!-- </div> -->
                                <div class="nk-block nk-block-lg">
                                <h4>Text Editor</h4>
                                        <div class="card card-bordered card-preview p-4">
                                            <div class="form-group">
                                                 <label class="form-label" for="default-02">Title</label>
                                                <div class="form-control-wrap">
                                                    <input class="form-control" name="text_editor_title" id="default-textarea-title">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="form-label" for="editor-text-section">Text Editor</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="text_editor_text" id="editor-text-section"></textarea>
                                                </div>
                                            </div>  
                                            <!-- <div class="learn-list-section">
                                            <div class="form-group">
                                            <label class="form-label" for="default-02">Learn list</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="learn_list" id="learn-list">
                                                </div>
                                            </div>  
                                             
                                            </div>
                                            <div class="col-lg-4 mt-2">
                                                <button class="btn btn-primary" id="add-learn-list" >Add more</button>
                                            </div> -->
                                        </div>
                                </div>
                                <!--  Right image section with left text -->
                                <div class="nk-block nk-block-lg">
                                <h4>Right Image with left text</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                 <label class="form-label" for="default-02">Title</label>
                                                <div class="form-control-wrap">
                                                    <input class="form-control" name="right_section_title" id="right-section-title">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="form-label" for="default-02">Image</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" name="right_section_image" class="form-control">
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Caption</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="right_section_caption" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="form-group ">
                                            <label class="form-label" for="editor-right-sction">About description</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="right_section_description" id="editor-right-sction"></textarea>
                                                </div> 
                                            </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  left image section with right text -->
                                <div class="nk-block nk-block-lg">
                                <h4>Left Image with Right text</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                 <label class="form-label" for="default-02">Title</label>
                                                <div class="form-control-wrap">
                                                    <input class="form-control" name="left_section_title" id="left-section-title">
                                                </div>
                                            </div>
                                            <div class="form-group>
                                            <label class="form-label" for="default-02">Image</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" name="left_section_image" class="form-control">
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Caption</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="left_section_caption" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="form-group ">
                                            <label class="form-label" for="editor-left-section">About description</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="left_section_description" id="editor-left-section"></textarea>
                                                </div> 
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Gallery -->
                                <div class="nk-block nk-block-lg">
                                <h4>Gallery Section</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                                 <label class="form-label" for="default-02">Title</label>
                                                <div class="form-control-wrap">
                                                    <input class="form-control" name="Gallery_section_title" id="gallery-section-title">
                                                </div>
                                            </div>
                                        <div class="form-group ">
                                        <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gallery_images" name="gallery_images[]" multiple onchange="javascript:updateList()">
                                                <label class="custom-file-label" for="gallery_images">
                                                <img width="30" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAQlBMVEX///8AAABhYWFlZWWSkpL19fW9vb01NTXf398kJCTw8PBRUVGdnZ1dXV3m5uZ0dHR8fHzExMSMjIzU1NSxsbEhISGIc9b1AAADv0lEQVR4nO2d607jMBhEa1pa6AVaLu//qgixq2+XxmlSe+IZa85vazQjhZMCarJaGWOMMcYYc8WxdQE0m7RpXQHLNqW0bV0CyVP65ql1DRyP6YfH1kVg7P4s3LUugmKd/rJuXQXDJgVdCnWb/qVDoT6l/+lOqI/pN70JdXe1sDOhrq8GdibUzcDAroS6HRzYkVB/a7Q7oV5rtDehXms06EKoQxoNOhDqsEYDeaHmNBqICzWv0UBaqGMaDZSFOqbRQFio4xoNZIV6S6OBqFBvazSQFOoUjQaCQp2m0UBPqNM0GsgJdapGAzGhTtdoICXUORoNhIQ6T6OBjFDnajRQEepcjQYiQp2v0UBCqPdoNBAQ6n0aDeiFeq9GA3Kh3q/RgFuo92s0oBZqiUYDYqGWaTSgFWqpRgNSoZZrNKAUag2NBoxCraHRgFCodTQa0Am1lkYDMqHW02hAJdSaGg2IhFpXowGPUOtqNKARam2NBiRCra/RgEKoCI0GBELFaDRoLlSURoPWQkVpNGgsVJxGg6ZCRWo0aChUrEaDZkJFazRoJFS8RoM2QsVrNGgi1NOCA1M6LT9we3iYzPp5sPXzenrEgeDj2xjDt02S3xyq8DC48KF1rYp4oT5eqI8X6uOF+nihPl6ojxfq44X6eKE+XqiPF+rjhfp4oT5eqI8X6uOF+nihPl6ojxfq44X6eKE+XqiPF+rjhfp4oT5eqI8XLsVhsMehQjJu4bzOuB4sySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wySw9cMksPXDJLD1wybgew8/nq/EcPZaFb6eBx+id3ioksyzE4YUlpznwwpLTHHhhyWkOvLDkNAdeWHKaAy8sOc2BF5ac5sALS05z4IUlpznwwpLTHNRYyP2OhuH3SsxbOOc9G4uTeTdIbuESr6dahtx1d25drBrnzMJj62LVOGYWXloXq8Yls3Dfulg19pmFq8/WzSrxnBu40Kvw8ORftvfSulolXrILM99XVGPsO6HvrctV4X1k4cKvi8Mw/s/zHm4Y2VvFDx+t+xXzMT5wtXpt3bCQ11sD1X066bv1yhMnPjxA90KdcIn+oKqbm5IJ9or3xdON28Qv3tV+Gg+jn2QGedkM/5WHkc/NyIftMfaX45n5L23frM/Hy7zL0xhjjDHGEPIFcc477O4fZUsAAAAASUVORK5CYII=" /> Add Multiple images</label>
                                            </div>
                                            <ul id="fileList" class="file-list"></ul>
                                        </div>
                                        </div>
                                </div>
                                </div>
                                <!-- contact section -->
                                <div class="nk-block nk-block-lg">
                                <h4>Contact Section</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-02">Title</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" name="contact_section_title" id="contact-section-title">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                    <label class="form-label" for="default-02">Address</label>
                                                        <div class="form-control-wrap">
                                                        <input type="text" name="address" class="form-control">
                                                        </div> 
                                                    </div> 
                                                    <div class="form-group ">
                                                    <label class="form-label" for="default-02">Contact Number</label>
                                                        <div class="form-control-wrap">
                                                        <input type="text" name="phone" class="form-control">
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group ">
                                                    <label class="form-label" for="default-02">Email</label>
                                                        <div class="form-control-wrap">
                                                        <input type="email" name="email" class="form-control">
                                                        </div> 
                                                    </div> 
                                                    <div class="form-group ">
                                                    <label class="form-label" for="default-02">Site Address</label>
                                                        <div class="form-control-wrap">
                                                        <input type="text" name="site_address" class="form-control">
                                                        </div> 
                                                    </div> 
                                                    </div>
                                                 </div>
                                        </div>
                                </div>
                                <div class="nk-block nk-block-lg">
                                <h4>Footer</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                        <label class="form-label" for="default-02">Title</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" name="footer_section_title" id="footer-section-title">
                                                        </div>
                                                    </div>
                                                <div class="form-group ">
                                                    <label class="form-label" for="editor">Disclaimer</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control" name="disclaimer_text" id="editor"></textarea>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <div class="nk-block nk-block-lg">
                                    <button type="submit" class="btn btn-primary" id="submitbutton">submit</button>
                                </div>
        </form>
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
    ClassicEditor.create( document.querySelector( '#editor-left-section' ) );
    ClassicEditor.create( document.querySelector( '#editor-right-sction' ) );
    ClassicEditor.create( document.querySelector( '#editor-text-section' ) );
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
    i = 0;
    $('#addsession').click(function(e){
        e.preventDefault();
        i++;
        html = '<h4>Session '+ i +'</h4> <div class="col-lg-6 p-1"><div class="form-group"><label class="form-label" for="default-02">Start date</label><div class="form-control-wrap"><input type="date" name="session_start_date[]" id="session_start_date" class="form-control"></div></div><div class="form-group"><label class="form-label" for="default-02">Start time</label><div class="form-control-wrap"><input type="time" name="session_start_time[]" id="session_start_time" class="form-control"></div></div></div><div class="col-lg-6"><div class="form-group"><label class="form-label" for="default-02">Place</label><div class="form-control-wrap"><input type="text" name="session_place[]" id="session_place" class="form-control"></div></div></div><hr class="mt-1">';
        // console.log(html);
        $('#session_outer_div').append(html);
    })
</script>   
<script>
    $(document).ready(function(){
        $("body").delegate("#select-events", "change", function (e) {
            if($(this).val() == 'mulitple'){
                $('#session_start_date').val('');
                $('#session_start_time').val('');
                $('#session_place').val('');
                $('#note').val('');
                $('#session_close_date').val('');
                    $('.session_div').hide();
                    $('#addsession').parent().removeClass('d-none')
            }else{
                $('#session_start_date').val('');
                $('#session_start_time').val('');
                $('#session_place').val('');
                $('#note').val('');
                $('#session_close_date').val('');
                $('#session_outer_div').html('');
                    $('.session_div').show();
                    $('#addsession').parent().addClass('d-none')
            }
        });
    });
</script>   
        <script>
            updateList = function() {
            var input = document.getElementById('gallery_images');
            var output = document.getElementById('fileList');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children +=  '<li>'+ input.files.item(i).name + '<span class="remove-list" onclick="return this.parentNode.remove()">X</span>' + '</li>'
            }
            output.innerHTML = children;
        }
        </script>             
@endsection
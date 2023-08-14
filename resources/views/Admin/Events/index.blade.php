@extends('admin_layout/index')
@section('content')
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@jsuites/cropper/cropper.min.css" type="text/css" />
<form action="{{ url('/admin-dashboard/events/save') }}" method="post" class="eventform" id="eventform" enctype="multipart/form-data">
                                                @csrf
                                <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <div class="col-lg-6">
                                            <div class="card-inner">
                                               
                                                <div class="form-group">
                                                            <label class="form-label" for="default-01">Event Title</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control" id="default-01" name="title" placeholder="Input placeholder">
                                                            
                                                            <input type="file" id="imageInput" name="file" class="d-none"></div>
                                                 </div>
                                                 <label class="form-label" for="default"> Upload Image</label>
                                                 <div style="display: flex;">
                                                    <div id="image-cropper" style="border:1px solid #ccc; margin: 5px;"></div>
                                                </div>
                                                <textarea name="imagepath" id="imagepath" cols="30" rows="10" class="d-none"></textarea>
                                                
                                           
                                                <div class="form-group">
                                                    <button type="button" id="submitbutton" class="btn btn-success">Submit</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- .card-preview -->
                                
                                <div class="nk-block nk-block-lg">
                                <h4>Learn Section</h4>
                                        <div class="card card-bordered card-preview p-4">
                                            <div class="form-group">
                                            <label class="form-label" for="default-02">Learn header</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" id="default-textarea">Large text area content</textarea>
                                                </div>
                                            </div>  
                                            <div class="learn-list-section">
                                            <div class="form-group">
                                            <label class="form-label" for="default-02">Learn list</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="learn_list" id="learn-list">
                                                </div>
                                            </div>  
                                             
                                            </div>
                                            <div class="col-lg-4 mt-2">
                                                <button class="btn btn-primary" id="add-learn-list" >Add more</button>
                                            </div>
                                        </div>
                                </div>
                                <!-- about section -->
                                <div class="nk-block nk-block-lg">
                                <h4>About Section</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                            <div class="form-group col-6">
                                            <label class="form-label" for="default-02">About Image</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" name="about_image" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="about_name" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Profession</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="about_profession" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Mobile Number</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="about_mobile" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">About description</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="about_description" id="about-textarea"></textarea>
                                                </div> 
                                            </div>
                                        </div>
                                </div>
                                <!-- contact section -->
                                <div class="nk-block nk-block-lg">
                                <h4>Contact Section</h4>
                                        <div class="card card-bordered card-preview p-4 ">
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
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Email</label>
                                                <div class="form-control-wrap">
                                                 <input type="email" name="email" class="form-control">
                                                </div> 
                                            </div> 
                                            <div class="form-group ">
                                            <label class="form-label" for="default-02">Site Address</label>
                                                <div class="form-control-wrap">
                                                 <input type="text" name="address" class="form-control">
                                                </div> 
                                            </div> 
                                        </div>
                                </div>
                                <div class="nk-block nk-block-lg">
                                <h4>Last Section</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                        <div class="form-group ">
                                            <label class="form-label" for="default-02">Add Content</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="last_section" id="about-textarea"></textarea>
                                                </div> 
                                            </div>
                                        </div>
                                </div>
                                <div class="nk-block nk-block-lg">
                                <h4>Footer</h4>
                                        <div class="card card-bordered card-preview p-4 ">
                                        <div class="form-group ">
                                            <label class="form-label" for="default-02">Footer</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="footercontent" class="form-control">
                                                </div> 
                                            </div>
                                        </div>
                                </div>
        </form>
<script>
$('#add-learn-list').click(function(e){
    e.preventDefault();
    html ='<div class="form-group"><div class="form-control-wrap"><input type="text" class="form-control" name="learn_list[]" id="learn-list"></div></div>';
    
    console.log('done');
    $('.learn-list-section').append(html);
});
</script>
<script>
    ClassicEditor.create( document.querySelector( '#editor{{ $data->id }}' ) );
</script>


<script>
cropper(document.getElementById('image-cropper'), {
    area: [ 500, 300 ],
    // crop: [ 100, 100 ],
})
 
$(document).ready(function(){
    $('#submitbutton').on('click',function(e){
        // e.preventDefault();
        url = document.getElementById('image-cropper').crop.getCroppedImage().src;
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
            $('#eventform').submit();
            console.log(file);
    })
})

</script>                     
@endsection
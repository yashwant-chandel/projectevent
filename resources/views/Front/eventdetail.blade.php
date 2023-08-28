<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}" />
    <title>RSVP- home page</title>
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  </head>
  <style>
      .banner-sec::after {
     background-image: url('{{ asset($events->background_image) }}');
      }
  </style>
  <body>
    <header>
      <div class="site_header">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light">
              <a class="navbar-brand" href="#"
                ><img src="{{ asset($events->logo_path) }}" alt="" class="img-fluid"
              /></a>
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
              <span class="bar bar1"></span>
              <span class="bar bar2"></span>
              <span class="bar bar3"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                  <?php $i = 0; ?>
                  @foreach($section as $s)
                  <li class="nav-item @if($i == 0) active @endif">
                    <a class="nav-link" aria-current="page" href="#{{ $s->slug ?? '' }}"
                      >{{ $s->title ?? '' }}</a>
                  </li>
                  <?php $i++; ?>
                  @endforeach
                </ul>
              </div>
            
          </nav>
        </div>
      </div>
    </header>
<form action="{{ url('rsvp/aptsubmit') }}" method="post" id="userregister">
  @csrf
    <section
      class="banner-sec">
      <div class="container">
        <div class="banner-content">
          <div class="row banner-row">
            <div class="col-lg-6 col-md-12">
              <div class="seminar-info">
              <?php echo $events->sub_title; ?>  
                <?php 
                  $dayofweek = date('D', strtotime($events->session['start_date']));
                  $month = date('M', strtotime($events->session['start_date']));
                  $day = date('d',strtotime($events->session['start_date']));
                 ?>
                <div class="date">
                  <div class="time-block">
                    <h3><?php echo strtoupper($dayofweek); ?> / <?php echo strtoupper($month); ?></h3>
                    <h2><?php echo $day; ?></h2>
                  </div>
                  <div class="address">
                   <?php echo $events->session['note'];  ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="register-form">
                <h2>Register for next events.</h2>
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-block">
                        <input type="hidden" name="event_id" value="{{ $events->id ?? '' }}">
                        <input type="text" name="first_name" id="" placeholder="First Name"/>
                      </div>
                      @if ($errors->has('first_name'))
                          <span class="text-danger">{{ $errors->first('first_name') }}</span>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="input-block">
                        <input type="text" name="last_name" id="" placeholder="Last Name" />
                      </div>
                      @if ($errors->has('last_name'))
                          <span class="text-danger">{{ $errors->first('last_name') }}</span>
                      @endif
                    </div>
                    <div class="col-md-12">
                      <div class="input-block">
                        <input type="text" name="mobile_phone" id="" placeholder="Mobile Phone"/>
                      </div>
                      @if ($errors->has('mobile_phone'))
                          <span class="text-danger">{{ $errors->first('mobile_phone') }}</span>
                      @endif
                    </div>
                    <div class="col-md-12">
                      <div class="input-block">
                        <input type="email" name="email" id="" placeholder="Email"/>
                      </div>
                      @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="input-block">
                        <input type="text" name="address" id="" placeholder="Address"/>
                      </div>
                      @if ($errors->has('address'))
                          <span class="text-danger">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="input-block">
                        <input type="text" name="apt" id="" placeholder="Apt"/>
                        @if ($errors->has('apt'))
                          <span class="text-danger">{{ $errors->first('apt') }}</span>
                      @endif
                      </div>
                  
                    </div>
                  </div>
                </form>
                <div class="event">
                    <h6>Event Dates</h6>
                    <div class="event_time-block">  
                        <ul class="list-group">
                          @if($events->session_type == 'single')
                          <?php 
                          $date = date('d M, Y',strtotime($events->session['start_date'])); 
                          $event_time = date('H:i A',strtotime($events->session['start_time']));
                          ?>
                          <label for="multievent{{ $events->session['id'] ?? '' }}">
                            <li class="list-group-item">
                                <p><?php print_r($date);  ?></p>
                                <i class="fa-regular fa-clock"></i><span><?php print_r($event_time); ?></span> 
                            </li>
                            </label>
                            <input type="radio" class="d-none" name="event_date" id="multievent{{ $events->session['id'] ?? '' }}" value="{{ $events->session['id'] ?? '' }}">
                            @else
                            @foreach($multiple_session as $ms)
                            <?php 
                            $multidate = date('d M, Y',strtotime($ms['start_date'])); 
                            $multievent_time = date('H:i A',strtotime($ms['start_time']));
                            ?>
                          <label for="multievent{{ $ms->id ?? '' }}">
                            <li class="list-group-item">
                                <p><?php echo $multidate; ?></p>
                                <i class="fa-regular fa-clock"></i><span><?php echo $multievent_time; ?></span> 
                            </li>
                            </label>
                            <input type="radio" class="d-none" name="event_date" id="multievent{{ $ms->id ?? '' }}" value="{{ $ms->id ?? '' }}">
                            @endforeach
                            @endif
                          </ul>               
                </div>
              </div>
              <div class="note-block">
               <div class="guest">
                
               </div>
                <div class="note-link">
                <a href="javascript:void(0)" id="show">Add a guest</a>
                </div>
                <div class="note-link">
                    <a href="javascript:void(0)" id="show1">Add a Note</a>
                </div>
                <div class="guest2">
                  <div class="guest-input note">
                    <input type="text" name="note" id="" placeholder="Add Note"/>
                  </div>
                </div>
              </div>
              <div class="check-block">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        <span>By checking this box I agree to have a licensed insurance agent call and/or email me about Medicare Advantage, Medicare Part D Prescription Drug Plans and/or Medicare Supplement insurance. I understand that by registering for this event, I will receive emails or mail from Medicare Square, such as a confirmation and reminder email. By checking this box, I authorize Medicare Square to occasionally send me additional educational and reminder emails. I can unsubscribe to communication from Medicare Square at any time and I also understand that the firm will not share or sell my information to anyone.</span>
                        
                    </label>
                  </div>
              </div>
              <div class="req-btn">
                <!-- <a href="javascipt:void(0)" class="btn cta yellow-cta">Request More Information</a> -->
                <input type="submit" class="btn cta yellow-cta" value="Request More Information">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
    @foreach($section as $sec)
    @if($sec->section_name == 'text-editor-section')
    <section class="editor-sec" id ="{{ $sec->slug ?? '' }}">
      <div class="container">
        <div class="editor-content">
        <?php print_r($sec->event_data['text_editor']);
            ?>
        </div>
      </div>
    </section>
    @elseif($sec->section_name == 'right-image-section')
    <section class="about-sec py_50" id="{{ $sec->slug ?? '' }}">
        <div class="container">
            <div class="about-content">
                <div class="row">
                    <div class="col-md-6 profile-block">
                        <div class="card">
                          <img src="{{ url('image/'.$sec->event_data['right_image_with_left_text_image']) }}" alt="" class="img-fluid">
                          <div class="body ">
                            <div class="peter-wrap">
                              
                             <?php print_r($sec->event_data['right_image_with_left_text_caption']); ?>
                             
                          </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="about-heading">
                        <h2>About Us</h2>
                        <h6>Citizen Advisory Group</h6>
                        <div class="about-block">
                        <?php print_r($sec->event_data['right_image_with_left_text_description']); ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @elseif($sec->section_name == 'left-image-section')
    <section class="about-sec py_50" id="{{ $sec->slug ?? '' }}">
        <div class="container">
            <div class="about-content">
                <div class="row">
                    
                    <div class="col-md-6">
                      <div class="about-heading">
                        <h2>About Us</h2>
                        <h6>Citizen Advisory Group</h6>
                        <div class="about-block">
                        <?php print_r($sec->event_data['left_image_with_right_text_description']); ?>  
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 profile-block">
                        <div class="card">
                          <img src="{{ url('image/'.$sec->event_data['left_image_with_right_text_image']) }}" alt="" class="img-fluid">
                          <div class="body ">
                            <div class="peter-wrap">
                            <?php print_r($sec->event_data['left_image_with_right_text_caption']); ?>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @elseif($sec->section_name == 'gallery-section')
    <section class="gallery-sec py_50" id="{{ $sec->slug ?? '' }}">
      <div class="container">
        <div class="gallery-content">
              <div class="gallery-head">
                <h2>Gallery</h2>
                <h6>Recent Events</h6>
                <?php  $images = json_decode($sec->event_data['gallery_section_images']);
                $count = 0;
                ?>
              </div>
               @if( count($images) > 2)
              <div class="gallery-slider{{ $sec->id ?? '' }}">
                @foreach($images as $i)
                <div class="gallery">
                  <img src="{{ asset('image/'.$i) }}" alt="" class="img-fluid">
                </div>
               @endforeach
              </div>
               @endif
        </div>
      </div>
    </section>
 <script>
  jQuery(document).ready(function ($) {
  $(".gallery-slider{{ $sec->id ?? '' }}").slick({
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: '{{ count($images)-1 }}',
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    prevArrow:
      '<button class="slide-arrow prev-arrow"><i class="fa-solid fa-arrow-left"></i></button>',
    nextArrow:
      '<button class="slide-arrow next-arrow"><i class="fa-solid fa-arrow-right"></i></button>',
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 4,
        },
      },
    ],
  });
});
 </script>
    @elseif($sec->section_name == 'contact-section')
    <section class="contact_wrapper py_50" id="{{ $sec->slug ?? '' }}">
      <div class="container">
          <div class="row contact-content">
              <div class="col-lg-5">
                  <div class="contact_cotent">
                      <h2>Contact</h2>
                      <h6>Stay in Touch</h6>
                      <ul class="list-unstyled">
                          <li>
                              <div class="con_icon">
                                <i class="fa-regular fa-envelope"></i>
                              </div>
                              <div class="sup_link">
                                  <a href="{{ $sec->event_data['contact_section_email'] ?? '' }}">{{ $sec->event_data['contact_section_email'] ?? '' }}</a>                               
                              </div>
                          </li>
                          <li>
                              <div class="con_icon">
                                <i class="fa-solid fa-phone"></i>
                              </div>
                              <div class="sup_link">
                                  <a href="tel:{{ $sec->event_data['contact_section_contact'] ?? '' }}">{{ $sec->event_data['contact_section_contact'] ?? '' }}</a>
                              </div>
                          </li>
                          <li>
                              <div class="con_icon">
                                <i class="fa-solid fa-building"></i>
                              </div>
                              <div class="sup_link">
                                  <p>
                                  {{ $sec->event_data['contact_section_address'] ?? '' }}
                                  </p>
                              </div>
                          </li>
                          <li>
                            <div class="con_icon">
                              <i class="fa-solid fa-globe"></i>
                            </div>
                            <div class="sup_link">
                               <a href="//{{ $sec->event_data['contact_section_site_address'] ?? '' }}">{{ $sec->event_data['contact_section_site_address'] ?? '' }}</a>
                            </div>
                        </li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-7 map-block">
                @if($sec->event_data['map_status'] == 1)
               <div class="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3422.317923087717!2d76.7179!3d30.7046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a83a1a7b3abef%3A0x66a8372c54ebbd4d!2sMohali%2C%20Punjab%2C%20India!5e0!3m2!1sen!2sus!4v1629778773635!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
               </div>
               @endif
               <a href="#" class="scrollToTop" id="myBtn"><i class="fa-solid fa-arrow-up"></i></a>
              </div>
              
          </div>
    
      </div>
  </section>
  @elseif($sec->section_name == 'disclaimer_text')
 <section class="bottom-sec" id="{{ $sec->slug ?? '' }}">
  <div class="container">
    <div class="bottom-content">
    <?php print_r($sec->event_data['footer_disclaimer']);  ?>  
    </div>
  </div>
 </section>
 @endif
 @endforeach

 <section class="copyright-sec">
  <div class="copyright-block">
    <p>By submitting your registration, you agree to our </p>  <a href="javascript:void(0)">Privacy Policy.</a>
  </div>
 </section>
<script>
  $('#userregister').on('submit',function(e){
    e.preventDefault();
    formData = new FormData(this);
    if($('#defaultCheck1').is(':checked')){
      $(this).submit();
    }else{
   return false;
    }
  });
</script>
<script>
  $(document).ready(function () {
    i = 0;
    $("#show").click(function () {
      i++;
     html = '<div class="guest-input"> <h5>Guest '+i+'</h5><input type="text" name="guest_first_name[]" id="" placeholder="First Name"><input type="text" name="guest_last_name[]" id="" placeholder="Last Name"></div>';
     $('.guest').append(html);
    });
  });
</script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>

    <script src="{{ asset('admin-theme/assets/js/bundle.js') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>
    @if(Session::get('error'))
<script>
    toastr.clear();
    NioApp.Toast('{{ Session::get("error") }}', 'error', {position: 'top-right'});
</script>
@endif
@if(Session::get('success'))
<script>
  alert('{{ Session::get("success") }}');
    toastr.clear();
     NioApp.Toast('{{ Session::get("success") }}', 'info', {position: 'top-right'});
</script>
@endif   
  </body>
</html>

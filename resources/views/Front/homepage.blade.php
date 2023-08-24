
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
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}" />
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>RSVP- home page</title>
  </head>
  <body>
    <section class="form-sec" style="background-image: url({{ asset('front/img/rsvpbg.png') }})">
      <div class="rsvpcode">
        <h3>May I Have Your RSVP Code?</h3>
        <form action="">
          <div class="input-block">
            <input type="text" name="rsvp_code" id="rsvp_code" placeholder="RSVP Code" />
          </div>
          <div class="rsvp-btn">
            <a href="" id="rsvp_submit" class="btn cta">Click to RSVP</a>
          </div>
        </form>
      </div>
    </section>

    <script>
        $(document).ready(function(){
            $('#rsvp_submit').on('click',function(e){
                e.preventDefault();
                rsvp_code = $('#rsvp_code').val();
                console.log(rsvp_code);
                $.ajax({
                    method: 'post',
                    url: '{{ url('rsvpcheck') }}',
                    data: { code:rsvp_code,_token: '{{ csrf_token() }}' },
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                       if(response == 'error'){
                        console.log('done');
                       }else{
                        location.href = response;
                       }
                    }
                })
               
            })
        })
    </script>

   
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!-- <script src="{{ asset('front/js/script.js') }}"></script> -->
  </body>
</html>

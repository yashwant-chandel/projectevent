
  
  // scroll to top button
  let mybutton = document.getElementById("myBtn");
  
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };
  
  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  
  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
  
  
  // nav-link
  $(document).ready(function () {
    $(" .navbar-nav .nav-item ").on("click", function () {
      $(this).addClass("active").siblings().removeClass("active");
    });
  });
  
  // event list
  // $(document).ready(function () {
  //   $(" .event_time-block .list-group-item ").on("click", function () {
  //     $(this).addClass("active-list").siblings().removeClass("active-list");
  //   });
  // });
  
  // add note or guest
  
  $(document).ready(function () {
    $("#show1").click(function () {
      if ($(".guest2").is(":hidden")) {
        $(".guest2").show();
      } else {
        $(".guest2").hide();
      }
    });
  });
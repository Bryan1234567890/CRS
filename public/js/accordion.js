$(document).ready(function () {
   $(".accordion > .accordion-item")
     .first()
     .children(".accordion-collapse")
     .slideDown(200);

  $(".accordion-button").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).siblings(".accordion-collapse").slideUp(200);
      $(".accordion-button i")
        .removeClass("fa-chevron-up")
        .addClass("fa-chevron-down");
    } else {
      $(".accordion-button i")
        .removeClass("fa-chevron-up")
        .addClass("fa-chevron-down");
      $(this)
        .find("i")
        .removeClass("fa-chevron-down")
        .addClass("fa-chevron-up");
      $(".accordion-button").removeClass("active");
      $(this).addClass("active");
      $(".accordion-item").removeClass("active");
      $(this).parent(".accordion-item").addClass("active");
      $(".accordion-collapse").slideUp(200);
      $(this).siblings(".accordion-collapse").slideDown(200);
    }
  });
});

/* jQuery
================================================== */
// $(function() {
//   $('.acc__title').click(function(j) {
    
//     var dropDown = $(this).closest('.acc__card').find('.acc__panel');
//     $(this).closest('.acc').find('.acc__panel').not(dropDown).slideUp();
    
//     if ($(this).hasClass('active')) {
//       $(this).removeClass('active');
//     } else {
//       $(this).closest('.acc').find('.acc__title.active').removeClass('active');
//       $(this).addClass('active');
//     }
    
//     dropDown.stop(false, true).slideToggle();
//     j.preventDefault();
//   });
// });
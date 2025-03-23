let modal = (function () {
  /* --------------- MODAL FUNCTIONS --------------- */
  $(document).on("click", "[data-open-modal]", function (e) {
    e.preventDefault();
    let modal = $(this).attr("data-open-modal");
    let el = $("#" + modal);
    let $inputs = el.find("input");
    $inputs.each(function () {
      $(this).val("");
      // console.log('in');
    });
    _OpenModal(modal);
  });
  $(document).on("click", "[data-close-modal]", function (e) {
    e.preventDefault();
    $(this)
      .closest("[data-modal]")
      .closest(".modal-overlay")
      .removeClass("is-visible");
    $(this).closest("[data-modal]").removeClass("is-visible");
    if ($(this).closest("[data-modal]").hasClass("sub-modal")) {
      return false;
    }
    $("body").removeClass("modal-open");
  });
  function _OpenModal(modal) {
    $("[data-modal=" + modal + "]").addClass("is-visible");
    $("[data-modal=" + modal + "]")
      .closest(".modal-overlay")
      .addClass("is-visible");
    $("body").addClass("modal-open");
  }
  function _CloseModal(modal) {
    $("[data-modal=" + modal + "]").removeClass("is-visible");
    $("body").removeClass("modal-open");
  }

// data-open-modal="how-it-works-modal"
  $(".play-modal-vid").on("click", function (e) {
    e.preventDefault();

     _OpenModal("how-it-works-modal");
    document.getElementById("myVideo").load();
      document.getElementById("myVideo").play();

});
  

    $(".close-vid-modal").on("click", function (e) {
      e.preventDefault();

      _OpenModal("how-it-works-modal");

      document.getElementById("myVideo").pause();
    });
})();

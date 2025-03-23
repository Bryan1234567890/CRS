$(function () {
  //getting parameters in get request

  Refund.getRequestDetails();
  Refund.currency();

  $("#req-descriptor").on("input focus", function () {
    if ($(this).val().length > 0) {
      $("#descriptor-select").show();
    } else {
      $("#descriptor-select").hide();
    }
  });

  $("#descriptor-select").on("input", function () {
    $("#req-descriptor").val($(this).val());
    $(this).show();
  });

  $("#submitRequest").click(function (e) {
    e.preventDefault();
    // Validate.fields();

    // let i_length = $('#refundRequestDetails .i-error').length;

    // if(i_length == 0){

    // }

    Refund.request();
  });

  $("#closeModal").click(function () {
    $(".modal-container").hide();
  });
});

let Refund = {
  request: () => {
    let params = Serialize.form("#refundRequestDetails");
    console.log(params);

    $(".modal-container").fadeIn();
  },
  getRequestDetails: () => {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let first_six = url.searchParams.get("first_six");
    let last_four = url.searchParams.get("last_four");
    var first_name = url.searchParams.get("first_name");
    var first_name = first_name != null ? first_name : "";
    var last_name = url.searchParams.get("last_name");
    var last_name = last_name != null ? last_name : "";
    var amount = url.searchParams.get("amount");

    $("#firstSix").val(first_six);
    $("#lastFour").val(last_four);
    $("#purchaserName").val(first_name + " " + last_name);
  },
  currency: () => {
    $.when(Request.ajax({ request_type: "getCurrencyList" })).done(function (
      data
    ) {
      $.each(data, function (i, a) {
        $("#sel-currency").append(
          `<option value="${a["new-currency"]}">${a["name"]} - ${a["new-currency"]}</option>`
        );
      });
    });
  },
};

let Request = {
  ajax: (params = {}) => {
    return $.ajax({
      url: "./function.php",
      type: "POST",
      data: params,
      error: function (x, t, r) {
        console.log(x + " " + " " + t + " " + r);
      },
      beforeSend: function () {},
      success: function (data) {
        // console.log(data)
        // if(container != ''){
        //    let div = $(container);
        //    div.html(data);
        // }
      },
    });
  },
};

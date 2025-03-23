const refundModal = $("#refundModal");
const descriptor_search = $("#refund-modal-descriptor-search");
let helpOpt;

const API_ENDPOINT = "https://uat.ican4consumers.com/refund/api2";

// MODAL INIT

$(".refund-modal-btn").click(function (e) {
  e.preventDefault();

  MODAL.init();
});

//$(() => {
//    MODAL.init();
//})

// ====  MAIN MODAL ====

const MODAL = {
  init: () => {
    MODAL.reset();
    refundModal.fadeIn();
  },

  question: () => {
    DESCRIPTOR.refundModal.init();
    DESCRIPTOR.refundModal.get_selected().then((e) => {
      console.log(e);
      if (helpOpt == 1) {
        if (!e) {
          MODAL.final(1);
        } else {
          MODAL.final(2);
        }
      }

      if (helpOpt == 2) {
        if (!e) return;

        MODAL.final(2);
      }
    });
  },

  track_order: () => {
    MODAL.slide(2);
    $(".refund-modal-body-part").addClass("hidden");
    $(".refund-modal-track-order:not(.part2)").removeClass("hidden");
    $(".footer-buttons").addClass("hidden");
    $("#opt-buttons").removeClass("hidden");
  },

  track_order_2: () => {
    let txn = TXN.user_details;

    if (
      !txn.first6 ||
      !txn.last4 ||
      txn.first6.length < 6 ||
      txn.last4 < 4 ||
      !txn.firstname ||
      !txn.lastname
    )
      return;

    MODAL.slide(3);
    $(".refund-modal-body-part").addClass("hidden");
    $(".refund-modal-track-order.part2").removeClass("hidden");
    $(".opt-button").addClass("hidden");
    $(".refund-modal-track").removeClass("hidden");
  },

  track_now: () => {
    DESCRIPTOR.check_process_type();

    MODAL.slide(4);

    let txn = TXN.user_details;

    let params = {
      request_type: "search",
      mid: DESCRIPTOR.selected.merchant_id,
      descriptor: DESCRIPTOR.selected.descriptor_text,
    };

    if (helpOpt == 3 || helpOpt == 4) {
      if (txn.order_no) {
        params.order_no = txn.order_no;

        $.when(TXN.search(params)).done((e) => {
          MODAL.display_result(e);
        });
      } else {
        if (
          !txn.first6 ||
          !txn.last4 ||
          txn.first6.length < 6 ||
          txn.last4 < 4 ||
          !txn.firstname ||
          !txn.lastname ||
          !txn.time ||
          !txn.amount ||
          !txn.email_address
        )
          return;

        delete txn.order_no;

        params = {
          ...params,
          ...txn,
        };

        // console.log(params)

        $.when(TXN.search(params)).done((e) => {
          MODAL.display_result(e);
        });
      }
    }

    if (helpOpt == 5) {
      if (
        !txn.order_no ||
        !txn.first6 ||
        !txn.last4 ||
        txn.first6.length < 6 ||
        txn.last4 < 4 ||
        !txn.firstname ||
        !txn.lastname ||
        !txn.email_address
      )
        return;

      delete txn.time;
      delete txn.amount;

      params = {
        ...params,
        ...txn,
      };

      $.when(TXN.search(params)).done((e) => {
        MODAL.display_result(e);
      });
    }
  },

  display_result: (e) => {
    if (e.responsecode != 200) {
      MODAL.txn_not_found();
      return;
    } else {
      // console.log(e);

      $("#opt-buttons").removeClass("hidden");
      $(".opt-button").addClass("hidden");
      $(".refund-modal-track-result-item").removeClass("hidden");
      // console.log(helpOpt);
      if (helpOpt == 3) {
        $(".refund-modal-shipping").removeClass("hidden");
        $(".refund-modal-txn-info").addClass("hidden");
        $(".refund-modal-get-refund, .refund-modal-next").removeClass("hidden");
      }
      if (helpOpt == 4 || helpOpt == 5) {
        $(".refund-modal-next").removeClass("hidden");
        $(".refund-modal-txn-info").removeClass("hidden");
        $(".refund-modal-shipping").addClass("hidden");
      }
      if (helpOpt == 5) {
        $(".refund-modal-track-result-item.shipping").addClass("hidden");
        $(".refund-modal-cancel-member").removeClass("hidden");
        $(".refund-modal-refund-last").removeClass("hidden");
      }

      let txn = e.responsedetails;

      TXN.result = txn;

      switch (txn.order_status) {
        case "shipped_success":
          $(".ship_stat").text("shipped");
          break;

        case "failed_to_delivered":
          $(".ship_stat").text("failed to ship");
          break;

        default:
          break;
      }

      $(".refund-modal-track-result .track-result-skeleton").addClass("hidden");

      let shipping_date = new Date(txn.shipping_date);
      shipping_date = shipping_date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
      $(".ship_date").text(shipping_date);
      $(".courier").text(txn.shipping_carrier);
      $(".tracking_no").text(txn.tracking_number);
      $(".refund-modal-shipping *:not(.track-result-skeleton)").removeClass(
        "hidden"
      );

      $(".product_name").text(txn.order_description);
      let date_settled = txn.action.date.substring(0, 8);
      date_settled =
        date_settled.substring(0, 4) +
        "-" +
        date_settled.substring(4, 6) +
        "-" +
        date_settled.substring(6);
      date_settled = new Date(date_settled);
      date_settled = date_settled.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
      $(".date_settled").text(date_settled);
      $(".order_number").text(txn.order_id);

      $(".amount").text(txn.action.amount);
      $(".card_type").text(txn.cc_type);
      $(".first6_result").text(txn.cc_bin);

      $(".name").text(`${txn.first_name} ${txn.last_name}`);
      $(".address").text(`
                ${txn.country ? txn.country + ", " : ""}
                ${txn.state ? txn.state + ", " : ""}
                ${txn.city ? txn.city + ", " : ""}
                ${txn.address_1 ? txn.address_1 + ", " : ""}
                ${txn.address_2 ? txn.address_2 + ", " : ""}
            `);
      $(".email_address").text(txn.email);

      $(".shipping_name").text(
        `${txn.shipping_first_name} ${txn.shipping_last_name}`
      );
      $(".shipping_address").text(`
                ${txn.shipping_country ? txn.shipping_country + ", " : ""}
                ${txn.shipping_state ? txn.shipping_state + ", " : ""}
                ${txn.shipping_city ? txn.shipping_city + ", " : ""}
                ${txn.shipping_address_1 ? txn.shipping_address_1 + ", " : ""}
                ${txn.shipping_address_2 ? txn.shipping_address_2 + ", " : ""}
            `);
    }
  },

  track_membership: () => {
    MODAL.slide(2);
    $(".refund-modal-body-part").addClass("hidden");
    $(".refund-modal-track-membership").removeClass("hidden");
    $(".footer-buttons").addClass("hidden");
    $("#opt-buttons").removeClass("hidden");
    $(".opt-button").addClass("hidden");
    $(".refund-modal-track").removeClass("hidden");
  },

  cancelSsubscription: () => {
    MODAL.slide(5);
    let params = {
      request_type: "cancelSubscription",
      descriptor: DESCRIPTOR.selected.descriptor_text,
      mid: DESCRIPTOR.selected.merchant_id,
      ...TXN.user_details,
      email: TXN.user_details.email_address,
      first_name: TXN.user_details.firstname,
      last_name: TXN.user_details.lastname,
    };
    delete params.email_address;
    delete params.firstname;
    delete params.lastname;

    $.when(TXN.cancelSubscription(params)).done((e) => {
      $(".refund-modal-cancellation-request .inner").addClass("hidden");
      $(".refund-modal-cancellation-request .inner:not(.skeleton)").removeClass(
        "hidden"
      );

      $("#opt-buttons").removeClass("hidden");
      $(".cancellation-request-result").text(e.responsemsg);
      $(".refund-modal-cancel-member").addClass("hidden");
      $(".refund-modal-refund-last").addClass("hidden");
    });
  },

  txn_not_found: () => {
    $(".refund-modal-body-part").addClass("hidden");
    $(".refund-modal-not-found").removeClass("hidden");
    $("#opt-buttons").removeClass("hidden");
    $(".opt-button").addClass("hidden");
    $(".refund-modal-next").removeClass("hidden");
    TXN.result = "not-found";
  },

  final: (opt) => {
    $(".refund-modal-body-part").addClass("hidden");
    $(".refund-modal-final-opt").addClass("hidden");
    $(".refund-modal-final").removeClass("hidden");
    $(".footer-buttons").addClass("hidden");
    $("#question-buttons").removeClass("hidden");
    MODAL.slide(6);

    switch (opt) {
      case 1:
        $(".refund-modal-final-opt.opt1").removeClass("hidden");
        break;

      case 2:
        $(".refund-modal-final-opt.opt2").removeClass("hidden");
        $("#merchant").text(DESCRIPTOR.selected.descriptor_text);
        $("#merchant_phone").text(DESCRIPTOR.selected.contact_number);
        $("#merchant_email").text(DESCRIPTOR.selected.contact_email);
        break;

      case 3:
        $(".refund-modal-final-opt.opt3").removeClass("hidden");
        break;
      default:
        break;
    }
  },

  slide: (i) => {
    $(".viewport").removeClass("s1 s2 s3 s4 s5 s6");
    $(".viewport").addClass("s" + i);
  },

  reset: () => {
    MODAL.slide(1);
    $("#help-select").val(1);
    $(".footer-buttons").addClass("hidden");
    $("#refund-modal-start").removeClass("hidden");
    $(".refund-modal-body-part").addClass("hidden");
    $(".refund-modal-txn-info").addClass("hidden");
    $(".refund-modal-init").removeClass("hidden");
    DESCRIPTOR.selected = [];
    TXN.user_details = {
      order_no: "",
      first6: "",
      last4: "",
      firstname: "",
      lastname: "",
      time: "",
      amount: "",
      email_address: "",
    };
    TXN.result = {};
    $(".refund-modal-track-order input").val("");
    $(".refund-modal-track-membership input").val("");
    $(".item-info-text-result").text("");
    $(".refund-modal-shipping *:not(.track-result-skeleton)").addClass(
      "hidden"
    );
    $(".track-result-skeleton").removeClass("hidden");
    $(".opt-button").addClass("hidden");
    $(".refund-modal-next").removeClass("hidden");
    $(".refund-modal-cancellation-request .inner").addClass("hidden");
    $(".refund-modal-cancellation-request .inner.skeleton").removeClass(
      "hidden"
    );
  },

  close: () => {
    $(".refund-modal").fadeOut();
  },
};

$("#refund-modal-start").click(function (e) {
  e.preventDefault();

  helpOpt = $("#help-select").val();
  helpOpt = parseInt(helpOpt);

  switch (helpOpt) {
    case 1:
      MODAL.question();
      break;

    case 2:
      MODAL.question();
      break;

    case 3:
      MODAL.track_order();
      break;

    case 4:
      MODAL.track_order();
      break;

    case 5:
      MODAL.track_membership();
      break;

    default:
      break;
  }
});

$(".refund-modal-back").click((e) => {
  MODAL.reset();
});

$(".refund-modal-txn-user-details input").keyup(function (e) {
  let id = $(this).attr("id");

  if (id == "order_no") {
    if ($(this).val()) {
      $(".refund-modal-txn-user-details input:not(#order_no)").attr(
        "disabled",
        true
      );
      $(".opt-button").addClass("hidden");
      $(".refund-modal-track").removeClass("hidden");
    } else {
      $(".refund-modal-txn-user-details input:not(#order_no)").attr(
        "disabled",
        false
      );
      $(".opt-button").addClass("hidden");
      $(".refund-modal-next").removeClass("hidden");
    }
  } else {
    let all_empty = true;
    let valid = true;
    let inputs = $(".refund-modal-txn-user-details input:not(#order_no)");

    for (let input of inputs) {
      if ($(input).val()) {
        all_empty = false;
        break;
      }
    }

    if (all_empty)
      $(".refund-modal-txn-user-details input#order_no").attr(
        "disabled",
        false
      );
    else
      $(".refund-modal-txn-user-details input#order_no").attr("disabled", true);
  }
});

$(".refund-modal-track-order .refund-modal-txn-user-details input").change(
  function () {
    let id = $(this).attr("id");
    TXN.user_details[id] = $(this).val();
  }
);

$(".refund-modal-track-membership .refund-modal-txn-user-details input").change(
  function () {
    let id = $(this).attr("id");
    id = id.replace(/member_/, "");
    // console.log(id);
    TXN.user_details[id] = $(this).val();
  }
);

$(".refund-modal-txn-user-details input").keypress(function (e) {
  let id = $(this).attr("id");
  id = id.replace(/member_/, "");

  if ($(this).val().length >= 6 && id == "first6") e.preventDefault();

  if ($(this).val().length >= 4 && id == "last4") e.preventDefault();
});

$(".refund-modal-next").click(function (e) {
  e.preventDefault();

  if (Object.keys(TXN.result).length || TXN.result == "not-found") {
    MODAL.final(3);
    return;
  }

  MODAL.track_order_2();
});

$('.modal-track').click(function(e){
  $('#subscription-modal .viewport').removeClass("s1");
  $('#subscription-modal .viewport').removeClass("s2");
  // $(".viewport").addClass("s" + i);
});

$(".refund-modal-track").click(function (e) {
  e.preventDefault();

  MODAL.track_now();
});

$(".refund-modal-cancel-member").click(function (e) {
  e.preventDefault();

  MODAL.cancelSsubscription();
});

$(".refund-modal-refund").click(function () {
  TXN.refund();
});

$(".refund-modal-close").click(function () {
  MODAL.close();
});

///////////// TRANSACTION

const TXN = {
  result: {},

  user_details: {
    order_no: "",
    first6: "",
    last4: "",
    firstname: "",
    lastname: "",
    time: "",
    amount: "",
    email_address: "",
  },

  search: (params) => {
    return ajax({
      url: API_ENDPOINT,
      params: params,
      bfs: () => {
        $(".refund-modal-body-part").addClass("hidden");
        $(".refund-modal-track-result").removeClass("hidden");
        $(".footer-buttons").addClass("hidden");
        $(".refund-modal-track-result").scrollTop(0);
      },
    });
  },

  cancelSubscription: (params) => {
    return ajax({
      url: API_ENDPOINT,
      params: params,
      bfs: () => {
        $(".refund-modal-body-part").addClass("hidden");
        $(".refund-modal-cancellation-request").removeClass("hidden");
        $(".footer-buttons").addClass("hidden");
      },
    });
  },

  refund: () => {
    let txn = TXN.user_details;
    txn.date_purchased = txn.time;
    delete txn.time;
    let refund_link = "https://uat.ican4consumers.com/refund";
    let qry = "";
    for (let i in TXN.user_details) {
      qry += `${i}=${TXN.user_details[i]}&`;
    }
    qry += `descriptor=${DESCRIPTOR.selected.descriptor_text}`;
    window.location = refund_link + "?" + qry;
  },
};

/////////////// DESCRIPTOR AND SEARCH MODAL

const DESCRIPTOR = {
  refundModal: {
    init: () => {
      descriptor_search.fadeIn();
    },

    get_selected: async () => {
      return new Promise((resolve) => {
        $("#refund-modal-descriptor-close").click(function (e) {
          e.preventDefault();

          DESCRIPTOR.refundModal.close();

          DESCRIPTOR.refundModal.clear();

          resolve(null);
        });

        $("#search-descriptor-next").click(function (e) {
          e.preventDefault();

          DESCRIPTOR.refundModal.close();

          DESCRIPTOR.refundModal.clear();

          resolve(DESCRIPTOR.selected);
        });
      });
    },

    close: () => {
      descriptor_search.fadeOut();
    },

    clear: () => {
      $(".descriptor_key").val("");
      $("#search-descriptor-next").attr("disabled", true);
    },
  },

  search: (descriptor) => {
    let params = {
      request_type: "searchDescriptor",
      descriptor: descriptor,
    };

    let skeleton = $(".descriptor-searchfield li.skeleton");

    $.when(
      ajax({
        url: API_ENDPOINT,
        params: params,
        bfs: function () {
          skeleton.toggleClass("hidden");
        },
      })
    ).done((e) => {
      //   console.log(e);
      skeleton.toggleClass("hidden");

      DESCRIPTOR.results = e;

      let result = $(".descriptor-searchfield ul.results");
      for (let m of e) {
        result.append(`
                    <li>${m.descriptor_text}</li>
                `);
      }
    });
  },

  clear_results: () => {
    $(".descriptor-searchfield li:not(.skeleton)").remove();
    DESCRIPTOR.results = {};
  },

  check_process_type: () => {
    const PROCESS_TYPES = ["EMAIL-BASED", "FORWARDING", "BATCH-FILE", "ORR2"];

    if (
      PROCESS_TYPES.includes(DESCRIPTOR.selected.process_type.toUpperCase())
    ) {
      $(".refund-modal-redirection-alert").fadeIn();
      setTimeout(() => {
        TXN.refund();
      }, 3000);
      return;
    }
  },

  results: {},

  selected: [],
};

$(".descriptor_key").keyup(
  debounce(function (e) {
    DESCRIPTOR.clear_results();

    const _this = $(".descriptor_key");

    if ($(this).val().length < 5) return;
    // console.log($(this).val());
    DESCRIPTOR.search($(this).val());
  }, 600)
);

$(".descriptor-searchfield").on("click", " li:not(.skeleton)", function (e) {
  e.preventDefault();

  let descriptor = $(this).text();

  DESCRIPTOR.selected = DESCRIPTOR.results.filter(
    (e) => e.descriptor_text == descriptor
  )[0];

  DESCRIPTOR.clear_results();

  $(".descriptor-searchfield .descriptor_key").val(descriptor);
  $("#search-descriptor-next").attr("disabled", false);
  $(".refund-modal-txn-user-details input").attr("disabled", false);
});

/////////////// LIBS

const ajax = ({
  url,
  params = {},
  method = "GET",
  bfs = () => {},
  scs = () => {},
  err = () => {},
}) => {
  return $.ajax({
    url: url,
    type: method,
    data: params,
    beforeSend: () => {
      bfs();
    },
    success: () => {
      scs();
    },
    err: (x, t, r) => {
      console.log(x);
      console.log(t);
      console.log(r);
      err();
    },
  });
};

function debounce(func, wait, immediate) {
  var timeout;
  return function () {
    var context = this,
      args = arguments;
    var later = function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

const url_string = window.location.href;
let ref_url = new URL(url_string);

let popUrl = ref_url.searchParams.get("popup");

// console.log(popUrl);

if (popUrl == "refund") {
  MODAL.init();
}

const modal = $("#modal");
const descriptor_search = $("#modal-descriptor-search");
let helpOpt;

const API_ENDPOINT = "refund/api2";
// const API_ENDPOINT = "apiclient";

// MODAL INIT

$(".start-button").click(function (e) {
  e.preventDefault();

  MODAL.init();
});

//
//$(() => {
//    MODAL.init();
//})

//////////////// MAIN MODAL

const MODAL = {
  init: () => {
    MODAL.reset();
    modal.fadeIn();
  },

  question: () => {
    DESCRIPTOR.modal.init();
    DESCRIPTOR.modal.get_selected().then((e) => {
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
    setTimeout(() => {
      $(".modal-body-part").addClass("hidden");
      $(".modal-track-order:not(.part2)").removeClass("hidden");
      $(".footer-buttons").addClass("hidden");
      $("#opt-buttons").removeClass("hidden");
      $(".opt-button").addClass("hidden");
      $(".modal-next").removeClass("hidden");
      MODAL.checkFields();
    }, 400);
  },

  track_order_2: () => {
    if (!DESCRIPTOR.selected.descriptor_text) return;

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

    if (helpOpt == 4) {
      $(".modal-track").text("Proceed");
    } else {
      $(".modal-track").text("Track Order");
    }

    MODAL.slide(3);
    setTimeout(() => {
      $(".modal-body-part").addClass("hidden");
      $(".modal-track-order.part2").removeClass("hidden");
      $(".opt-button").addClass("hidden");
      $(".modal-track").removeClass("hidden");
    }, 400);
  },

  track_now: () => {
    if (!DESCRIPTOR.selected.merchant_id) return;

    let desc_type = DESCRIPTOR.check_process_type();

    if (!desc_type) return;

    if (helpOpt == 3 || helpOpt == 4) {
      if (
        !TXN.user_details.order_no &&
        !validateEmail($("#email_address").val())
      ) {
        $("#email_address").css("border-color", "red");
        return;
      } else {
        $("#email_address").css("border-color", "rgba(0,0,0,0.5)");
      }
    }

    if (helpOpt == 5) {
      if (!validateEmail($("#member_email_address").val())) {
        $("#member_email_address").css("border-color", "red");
        return;
      } else {
        $("#member_email_address").css("border-color", "rgba(0,0,0,0.5)");
      }
    }

    MODAL.slide(4);

    setTimeout(() => {
      let txn = TXN.user_details;

      let params = {
        request_type: "search",
        descriptor: DESCRIPTOR.selected.descriptor_text,
        refund_reason: $(`#help-select option[value=${helpOpt}]`).text(),
        purchaser_name:
          TXN.user_details.firstname + " " + TXN.user_details.last_name,
      };

      if (helpOpt == 3 || helpOpt == 4) {
        if (txn.order_no) {
          params.order_no = txn.order_no;

          $.when(TXN.search(params)).done((e) => {
            if (!parseResponse(e)) return;

            if (e.responsecode == 201) {
              MODAL.txn_not_found(1);
              return;
            }

            TXN.result = e.responsedetails;

            if (Array.isArray(TXN.result)) {
              if (TXN.result.length > 1) {
                MODAL.display_multiple_result(TXN.result);
                ORDER_SELECTION.init();
                ORDER_SELECTION.getSelection().then((res) => {
                  if (res == null) {
                    MODAL.track_order();
                    return;
                  }

                  MODAL.display_result(e.responsecode, res);
                });
                return;
              }

              MODAL.display_result(e.responsecode, TXN.result[0]);
            } else {
              MODAL.display_result(e.responsecode, TXN.result);
            }
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

          // if (DESCRIPTOR.selected.descriptor_text != 'testingwhitelabeling')
          //     params.time = params.time.split('T')[0];
          if (DESCRIPTOR.selected.process_type.toUpperCase() == "EMAIL-BASED") {
            params.request_type = "refund";

            $.when(
              ajax({
                url: API_ENDPOINT,
                params: params,
                bfs: () => {
                  $(".modal-body-part").addClass("hidden");
                  $(".modal-track-result:not(.proc-api)").removeClass("hidden");
                  $(".footer-buttons").addClass("hidden");
                  $(".modal-track-result").scrollTop(0);

                  if (helpOpt == 3) {
                    $(".modal-shipping").removeClass("hidden");
                    $(".modal-txn-info").addClass("hidden");
                  }

                  if (helpOpt == 4 || helpOpt == 5) {
                    // $('.modal-shipping').addClass('hidden');
                    $(".modal-txn-info").removeClass("hidden");
                  }
                },
                err: () => {
                  $(".modal-request-error").fadeIn();
                },
              })
            ).done(function (e) {
              console.log(e);

              if (e.responsecode == -1) {
                $(".refund-request-exist-alert").fadeIn();
                return;
              }

              var code = decodeURIComponent(e.responsedetails)
                .split("<br/>")[2]
                .replaceAll(/[A-Za-z',.]/g, "")
                .trim();
              console.log(code);

              $(".refund-request-modal #confirmation-code").text(code);
              $(".refund-request-modal").fadeIn();
            });

            return;
          }

          $.when(TXN.search(params)).done((e) => {
            console.log(e);

            if (!parseResponse(e)) return;

            if (e.responsecode == 201) {
              MODAL.txn_not_found(1);
              return;
            }

            TXN.result = e.responsedetails;

            if (Array.isArray(TXN.result)) {
              if (TXN.result.length > 1) {
                MODAL.display_multiple_result(TXN.result);
                ORDER_SELECTION.init();
                ORDER_SELECTION.getSelection().then((res) => {
                  if (res == null) {
                    MODAL.track_order();
                    return;
                  }

                  MODAL.display_result(e.responsecode, res);
                });
                return;
              }

              MODAL.display_result(e.responsecode, TXN.result[0]);
            } else {
              MODAL.display_result(e.responsecode, TXN.result);
            }
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
          !txn.email_address ||
          !txn.time ||
          !txn.amount
        )
          return;

        params = {
          ...params,
          ...txn,
        };

        // if (DESCRIPTOR.selected.descriptor_text != 'testingwhitelabeling')
        //     params.time = params.time.split('T')[0];

        $.when(TXN.search(params)).done((e) => {
          if (!parseResponse(e)) return;

          if (e.responsecode == 201) {
            MODAL.txn_not_found(1);
            return;
          }

          TXN.result = e.responsedetails;

          if (Array.isArray(TXN.result)) {
            if (TXN.result.length > 1) {
              MODAL.display_multiple_result(TXN.result);
              ORDER_SELECTION.init();
              ORDER_SELECTION.getSelection().then((res) => {
                if (res == null) {
                  MODAL.track_order();
                  return;
                }

                MODAL.display_result(e.responsecode, res);
              });
              return;
            }

            MODAL.display_result(e.responsecode, TXN.result[0]);
          } else {
            MODAL.display_result(e.responsecode, TXN.result);
          }
        });
      }
    }, 400);
  },

  display_result: (code, txn) => {
    if (code != 200 || !txn) {
      MODAL.txn_not_found();
      return;
    } else {
      $("#opt-buttons").removeClass("hidden");
      $(".opt-button").addClass("hidden");
      $(".modal-track-result-item").removeClass("hidden");
      $(".modal-next").attr("disabled", false);

      if (helpOpt == 3) {
        // $('.modal-shipping').removeClass('hidden');
        $(".modal-get-refund, .modal-next").removeClass("hidden");
        // $('.modal-txn-info').addClass('hidden');
      }
      if (helpOpt == 4 || helpOpt == 5) {
        $(".modal-next").removeClass("hidden");
        // $('.modal-txn-info').removeClass('hidden');
        // $('.modal-shipping').addClass('hidden');
      }
      if (helpOpt == 5) {
        $(".modal-track-result-item.shipping").addClass("hidden");
        $(".modal-cancel-member").removeClass("hidden");
        $(".modal-refund-last").removeClass("hidden");
      }

      // TXN.result = txn;
      ORDER_SELECTION.selected = txn;

      switch (txn.order_status) {
        case "shipped_success":
          $(".ship_stat").text("shipped");
          break;

        case "failed_to_delivered":
          $(".ship_stat").text("failed to ship");
          break;

        case "pendingsettlement":
          $(".ship_stat").text("pending");
          break;

        default:
          break;
      }

      $(".modal-track-result .track-result-skeleton").addClass("hidden");

      if (DESCRIPTOR.PROC_API()) {
        $(".modal-track-result.proc-api").removeClass("hidden");
        $(".modal-track-result:not(.proc-api)").addClass("hidden");
        $(".modal-txn-info").removeClass("hidden");
        let date = new Date(txn.time);
        date = date.toLocaleDateString("en-US", {
          month: "long",
          day: "numeric",
          year: "numeric",
        });

        $(".txn-id").text(txn.transactionid);
        $(".txn-first-6").text(txn.first6);
        $(".txn-last-4").text(txn.last4);
        $(".txn-amount").text("$ " + txn.amount);
        $(".txn-date").text(date);
        $(".txn-name").text(`${txn.firstname} ${txn.lastname}`);
        $(".txn-email").text(txn.email);
        $(".modal-shipping *:not(.track-result-skeleton)").removeClass(
          "hidden"
        );
      } else {
        $(".modal-track-result.proc-api").addClass("hidden");
        $(".modal-track-result:not(.proc-api)").removeClass("hidden");

        let shipping_date = new Date(txn.shipping_date);
        shipping_date = shipping_date.toLocaleDateString("en-US", {
          year: "numeric",
          month: "long",
          day: "numeric",
        });
        $(".ship_date").text(
          shipping_date != "Invalid Date" ? shipping_date : "- - -"
        );
        $(".courier").text(
          txn.shipping_carrier && typeof txn.shipping_carrier == "string"
            ? txn.shipping_carrier
            : "- - -"
        );
        $(".tracking_no").text(
          txn.tracking_number && typeof txn.tracking_number == "string"
            ? txn.tracking_number
            : "- - -"
        );
        $(".modal-shipping *:not(.track-result-skeleton)").removeClass(
          "hidden"
        );

        $(".product_name").text(txn.order_description);
        let date_settled;
        try {
          date_settled = txn.action.date;
          date_settled = new Date(date_settled);
          date_settled = date_settled.toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
          });
        } catch {
          date_settled = txn.action.date.substring(0, 8);
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
        }
        $(".date_settled").text(date_settled);
        $(".order_number").text(txn.order_id);

        $(".amount").text("$ " + txn.action.amount);
        $(".card_type").text(txn.cc_type);
        $(".first6_result").text(txn.cc_bin);

        $(".name").text(`${txn.first_name} ${txn.last_name}`);
        $(".address").text(`
                    ${txn.country ? txn.country + ", " : ""}
                    ${txn.state ? txn.state + ", " : ""}
                    ${txn.city ? txn.city + ", " : ""}
                    ${txn.address_1 ? txn.address_1 + ", " : ""}
                    ${txn.address_2 ? txn.address_2 : ""}
                `);
        $(".email_address").text(txn.email);

        $(".shipping_name").text(
          `${txn.shipping_first_name} ${txn.shipping_last_name}`
        );
        $(".shipping_address").text(`
                    ${txn.shipping_country ? txn.shipping_country + ", " : ""}
                    ${txn.shipping_state ? txn.shipping_state + ", " : ""}
                    ${txn.shipping_city ? txn.shipping_city + ", " : ""}
                    ${
                      txn.shipping_address_1
                        ? txn.shipping_address_1 + ", "
                        : ""
                    }
                    ${txn.shipping_address_2 ? txn.shipping_address_2 : ""}
                `);
      }
    }
  },

  display_multiple_result: (data) => {
    let txn_cards = $(".txn-cards");

    for (let txn of data) {
      if (DESCRIPTOR.PROC_API()) {
        let date = new Date(txn.time);
        date = date.toLocaleDateString("en-US", {
          month: "long",
          day: "numeric",
          year: "numeric",
        });

        txn_cards.append(`

                    <div class="txn-card" id="${txn.transactionid}">
                        <div class="radio">
                            <i class="far fa-circle"></i>
                            <i class="fas fa-check-circle hidden"></i>
                        </div>
                        <div class="content">
                            <div class="head">
                                <p class='product-name'>${txn.firstname} ${
          txn.lastname
        }</p>
                                <p class="order-no">${txn.transactionid}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Card number:</p>
                                <p>${txn.first6.slice(0, 4)} ${txn.first6.slice(
          4,
          6
        )}xx xxxx ${txn.last4}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Amount:</p>
                                <p>$ ${txn.amount}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Date Settled:</p>
                                <p>${date}</p>
                            </div>
                        </div>
                    </div>

                `);
      } else {
        let date;
        try {
          date = new Date(txn.action.date);
          date = date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
          });
        } catch {
          date = txn.action.date.substring(0, 8);
          date =
            date.substring(0, 4) +
            "-" +
            date.substring(4, 6) +
            "-" +
            date.substring(6);
          date = new Date(date);
          date = date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
          });
        }
        // let date = `${txn.action.date.substring(0,4)}-${txn.action.date.substring(0,2)}-${txn.action.date.substring(0,2)}`;
        // date = new Date(date);
        // date = date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

        txn_cards.append(`

                    <div class="txn-card" id="${txn.transaction_id}">
                        <div class="radio">
                            <i class="far fa-circle"></i>
                            <i class="fas fa-check-circle hidden"></i>
                        </div>
                        <div class="content">
                            <div class="head">
                                <p class='product-name'>${txn.first_name} ${
          txn.last_name
        }</p>
                                <p class="order-no">${txn.order_id}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Card number:</p>
                                <p>${txn.cc_bin.slice(0, 4)} ${txn.cc_bin.slice(
          4,
          6
        )}xx xxxx ${
          TXN.user_details.last4 ? TXN.user_details.last4 : "xxxx"
        }</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Amount:</p>
                                <p>$ ${txn.action.amount}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p>Date Settled:</p>
                                <p>${date}</p>
                            </div>
                        </div>
                    </div>

                `);
      }

      // let date_settled = txn.action.date;
      // date_settled = date_settled.substring(0, 4) + '-' + date_settled.substring(4, 6) + '-' + date_settled.substring(6, 8);
      // date_settled = new Date(date_settled);
      // date_settled = date_settled.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

      // txn_cards.append(`
      //     <div class="txn-card" id="${txn.tracking_number}">
      //         <div class="radio">
      //             <i class="far fa-circle"></i>
      //             <i class="fas fa-check-circle hidden"></i>
      //         </div>
      //         <div class="content">
      //             <div class="head">
      //                 <p class='product-name'>${txn.order_description}</p>
      //                 <p class="order-no">${txn.order_id}</p>
      //             </div>
      //             <p>Date Settled: ${date_settled}</p>
      //             <div class="other-details">
      //                 <div class="other-detail">
      //                     <div class="other-detail-item">
      //                         <p>Amount:</p>
      //                         <p>$${txn.action.amount}</p>
      //                     </div>
      //                     <div class="other-detail-item">
      //                         <p>Card Type:</p>
      //                         <p>${txn.cc_type}</p>
      //                     </div>
      //                     <div class="other-detail-item">
      //                         <p>First 6 Card Digit:</p>
      //                         <p>${txn.cc_bin}</p>
      //                     </div>
      //                 </div>
      //                 <div class="other-detail">
      //                     <div class="other-detail-item">
      //                         <p>Customer:</p>
      //                         <p>${txn.first_name} ${txn.last_name}</p>
      //                     </div>
      //                     <div class="other-detail-item">
      //                         <p>Address:</p>
      //                         <p>${txn.country ? txn.country + ',' : ''} ${txn.state ? txn.state + ',' : ''} ${txn.city ? txn.city + ',' : ''} ${txn.address_1 ? txn.address_1 + ',' : ''} ${txn.address_2 ? txn.address_2 : ''}</p>
      //                     </div>
      //                     <div class="other-detail-item">
      //                         <p>Email:</p>
      //                         <p>${txn.email}</p>
      //                     </div>
      //                 </div>
      //                 <div class="other-detail">
      //                     <div class="other-detail-item">
      //                         <p>Ship to:</p>
      //                         <p>${txn.shipping_first_name} ${txn.shipping_last_name}</p>
      //                     </div>
      //                     <div class="other-detail-item">
      //                         <p>Shipping Address:</p>
      //                         <p>${txn.shipping_country ? txn.shipping_country + ',' : ''} ${txn.shipping_state ? txn.shipping_state + ',' : ''} ${txn.shipping_city ? txn.shipping_city : ''} ${txn.shipping_address_1 ? txn.shipping_address_1 + ',' : ''} ${txn.shipping_address_2 ? txn.shipping_address_2 : ''}</p>
      //                     </div>
      //                     <div class="other-detail-item">
      //                         <p>Tracking Number:</p>
      //                         <p>${txn.tracking_number}</p>
      //                     </div>
      //                 </div>
      //             </div>
      //             <button class='more-details card-button'>More details <i class="fa fa-chevron-down"></i></button>
      //             <button class='hide-details card-button hidden'>Hide details <i class="fa fa-chevron-up"></i></button>
      //         </div>
      //     </div>
      // `);
    }
  },

  track_membership: () => {
    MODAL.slide(2);
    setTimeout(() => {
      $(".modal-body-part").addClass("hidden");
      $(".modal-track-membership").removeClass("hidden");
      $(".footer-buttons").addClass("hidden");
      $("#opt-buttons").removeClass("hidden");
      $(".opt-button").addClass("hidden");
      $(".modal-track").removeClass("hidden");
    }, 400);
  },

  cancelSsubscription: () => {
    MODAL.slide(5);
    let params = {
      request_type: "cancelSubscription",
      descriptor: DESCRIPTOR.selected.descriptor_text,
      mid: DESCRIPTOR.selected.merchant_id,
      ...TXN.user_details,
    };

    setTimeout(() => {
      $.when(TXN.cancelSubscription(params)).done((e) => {
        if (!parseResponse(e)) return;

        $(".modal-cancellation-request .inner").addClass("hidden");
        $(".modal-cancellation-request .inner:not(.skeleton)").removeClass(
          "hidden"
        );

        $("#opt-buttons").removeClass("hidden");
        $(".cancellation-request-result").text(e.responsemsg);
        $(".modal-cancel-member").addClass("hidden");
        $(".modal-refund-last").addClass("hidden");
      });
    }, 400);
  },

  txn_not_found: (try_other_opt = 0) => {
    $(".modal-body-part").addClass("hidden");
    $(".modal-not-found").removeClass("hidden");

    if (try_other_opt) {
      $(".modal-not-found h4").text(
        "The transaction/subscription based on the information you provided was not found. You may try the other option."
      );
    } else if (helpOpt == 5) {
      $(".modal-not-found h4").text(
        "The transaction/subscription based on the information you provided was not found. You may try the other option."
      );
    } else
      $(".modal-not-found h4").text(
        "The transaction/subscription based on the information you provided was not found."
      );

    $("#opt-buttons").removeClass("hidden");
    $(".opt-button").addClass("hidden");
    $(".modal-next").removeClass("hidden");
    $(".modal-next").attr("disabled", false);
    TXN.result = "not-found";
  },

  final: (opt) => {
    MODAL.slide(6);

    setTimeout(() => {
      $(".modal-body-part").addClass("hidden");
      $(".modal-final-opt").addClass("hidden");
      $(".modal-final").removeClass("hidden");
      $(".footer-buttons").addClass("hidden");
      $("#question-buttons").removeClass("hidden");

      switch (opt) {
        case 1:
          $(".modal-final-opt.opt1").removeClass("hidden");
          break;

        case 2:
          $(".modal-final-opt.opt2").removeClass("hidden");
          $("#merchant").text(DESCRIPTOR.selected.descriptor_text);
          $("#merchant_phone").text(DESCRIPTOR.selected.contact_number);
          $("#merchant_email").text(DESCRIPTOR.selected.contact_email);
          break;

        case 3:
          $(".modal-final-opt.opt3").removeClass("hidden");
          break;
        default:
          break;
      }
    }, 400);
  },

  slide: (i) => {
    $(".viewport").removeClass("s1 s2 s3 s4 s5 s6");
    $(".viewport").addClass("s" + i);
  },

  reset: () => {
    MODAL.slide(1);
    $("#help-select").val(1);
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
    $(".modal-track-order input").val("");
    $(".modal-track-membership input").val("");
    $(".descriptor_key").val("");
    $(".item-info-text-result").text("");
    $(".descriptor-searchfield .results li:not(.skeleton)").remove();
    $(".descriptor-searchfield .results li.skeleton").addClass("hidden");
    $(".txn-detail").attr("disabled", true);
    $(".txn-cards").html("");
    $(".issuer-icon").addClass("hidden");
    DESCRIPTOR.modal.close();
    ORDER_SELECTION.close();

    setTimeout(() => {
      $(".footer-buttons").addClass("hidden");
      $("#modal-start").removeClass("hidden");
      $(".modal-body-part").addClass("hidden");
      $(".modal-txn-info").addClass("hidden");
      $(".modal-init").removeClass("hidden");
      $(".modal-shipping *:not(.track-result-skeleton)").addClass("hidden");
      $(".track-result-skeleton").removeClass("hidden");
      $(".opt-button").addClass("hidden");
      $(".modal-next").removeClass("hidden");
      $(".modal-cancellation-request .inner").addClass("hidden");
      $(".modal-cancellation-request .inner.skeleton").removeClass("hidden");
      $(".modal-track").attr("disabled", true);
      $(".modal-next").attr("disabled", true);

      // MODAL.startTest();
    }, 400);
  },

  checkFields: () => {
    if (TXN.user_details.order_no) {
      $(".opt-button").addClass("hidden");
      $(".modal-track").removeClass("hidden");
    } else if (!TXN.user_details.order_no && $(".viewport").hasClass("s2")) {
      $(".opt-button").addClass("hidden");
      $(".modal-next").removeClass("hidden");
    }

    if (TXN.user_details.order_no) {
      $(".opt-button").addClass("hidden");
      $(".modal-track").removeClass("hidden");
      $(".modal-track").attr("disabled", false);
    } else if (
      TXN.user_details.first6 &&
      TXN.user_details.first6.length == 6 &&
      TXN.user_details.last4 &&
      TXN.user_details.last4.length == 4 &&
      TXN.user_details.firstname &&
      TXN.user_details.lastname &&
      TXN.user_details.email_address &&
      TXN.user_details.amount &&
      TXN.user_details.time
    ) {
      TXN.user_details.first_name = TXN.user_details.firstname;
      TXN.user_details.last_name = TXN.user_details.lastname;
      $(".modal-track").attr("disabled", false);
    } else {
      $(".modal-track").attr("disabled", true);
    }

    if (
      TXN.user_details.first6 &&
      TXN.user_details.first6.length == 6 &&
      TXN.user_details.last4 &&
      TXN.user_details.last4.length == 4 &&
      TXN.user_details.firstname &&
      TXN.user_details.lastname
    ) {
      TXN.user_details.first_name = TXN.user_details.firstname;
      TXN.user_details.last_name = TXN.user_details.lastname;
      $(".modal-next").attr("disabled", false);
    } else {
      $(".modal-next").attr("disabled", true);
    }
  },

  errorRequest: () => {
    $(".modal-request-error").fadeIn();
  },

  close: () => {
    $(".modal").fadeOut();
    MODAL.reset();
  },

  // FOR TESTING
  startTest: () => {
    TXN.user_details.amount = 111;
    TXN.user_details.email_address = "customer1@email.com";
    TXN.user_details.first6 = "411111";
    TXN.user_details.first_name = "Edris";
    TXN.user_details.firstname = "Edris";
    TXN.user_details.last4 = "2222";
    TXN.user_details.last_name = "Stern";
    TXN.user_details.lastname = "Stern";
    TXN.user_details.time = "2021-04-11";

    for (detail in TXN.user_details) {
      $("#" + detail).val(TXN.user_details[detail]);
      $("#member_" + detail).val(TXN.user_details[detail]);
    }
  },
};

$(".refund-request-modal button").click(function (e) {
  $(".refund-request-modal").fadeOut();
  MODAL.close();
});

$(".refund-request-exist-alert button").click(function (e) {
  $(".refund-request-exist-alert").fadeOut();
  MODAL.close();
});

$("#modal-start").click(function (e) {
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

  setTimeout(() => {
    $(".descriptor_key").focus();
  }, 500);
});

$(".modal-back").click((e) => {
  let viewport = $(".viewport");
  let slide = viewport.attr("class");
  slide = slide.replace(/viewport/g, "").trim();

  switch (slide) {
    case "s3":
      MODAL.track_order();
      break;

    case "s4":
      console.log(Object.keys(TXN.result), TXN.result);

      if (
        ((Array.isArray(TXN.result) && TXN.result.length > 1) ||
          Object.keys(TXN.result).length) &&
        helpOpt != 5 &&
        TXN.result != "not-found"
      ) {
        MODAL.reset();
      } else {
        if (TXN.result == "not-found" && (helpOpt == 3 || helpOpt == 4)) {
          TXN.user_details.time = "";
          TXN.user_details.amount = "";
          TXN.user_details.email_address = "";
          $("#time").val("");
          $("#amount").val("");
          $("#email_address").val("");
          TXN.result = {};
          MODAL.track_order();
        } else if (TXN.result == "not-found" && helpOpt == 5) {
          TXN.result = {};
          MODAL.track_membership();
        } else MODAL.reset();
      }
      break;
    // if (TXN.result.length > 1 && helpOpt != 5) {
    //     $('.modal-not-found').addClass('hidden');
    //     $('.modal-track-result').removeClass('hidden');
    //     ORDER_SELECTION.init();
    //     ORDER_SELECTION.getSelection().then(e => {
    //         if (e == null) {
    //             return;
    //         }

    //         MODAL.display_result(200, e);
    //     });
    // } else {
    //     MODAL.reset();
    // }
    // break;

    default:
      MODAL.reset();
      break;
  }
});

$(".modal-txn-user-details input").keyup(function (e) {
  let id = $(this).attr("id");

  if (id == "order_no") {
    if ($(this).val()) {
      $(".modal-txn-user-details input:not(#order_no)").attr("disabled", true);
      $(".opt-button").addClass("hidden");
      $(".modal-track").removeClass("hidden");
    } else {
      $(".modal-txn-user-details input:not(#order_no)").attr("disabled", false);
      $(".opt-button").addClass("hidden");
      $(".modal-next").removeClass("hidden");
    }
  } else {
    let all_empty = true;
    let valid = true;
    let inputs = $(".modal-txn-user-details input:not(#order_no)");

    for (let input of inputs) {
      if ($(input).val()) {
        all_empty = false;
        break;
      }
    }

    if (all_empty)
      $(".modal-txn-user-details input#order_no").attr("disabled", false);
    else $(".modal-txn-user-details input#order_no").attr("disabled", true);
  }
});

$(".modal-txn-user-details input").change(function (e) {
  let id = $(this).attr("id");
  id = id.replace(/member_/g, "");
  TXN.user_details[id] = $(this).val();
});

$(".modal-track-order .modal-txn-user-details input").keyup(function () {
  let id = $(this).attr("id");
  TXN.user_details[id] = $(this).val();

  if (id == "first6" && TXN.user_details.first6.length != 6) {
    $(".issuer-icon").addClass("hidden");
    $("#first6").css("border-color", "red");
  } else if (id == "first6" && TXN.user_details.first6.length == 6) {
    $("#first6").css("border-color", "rgba(0,0,0,0.5)");

    $.when(
      ajax({ url: `https://lookup.binlist.net/${TXN.user_details.first6}` })
    ).then((e) => {
      let scheme = e.scheme;

      if (scheme.match(/visa/gm)) {
        $("#visa").removeClass("hidden");
      } else if (scheme.match(/mastercard/gm)) {
        $("#mastercard").removeClass("hidden");
      } else if (scheme.match(/amex/gm)) {
        $("#amex").removeClass("hidden");
      } else if (scheme.match(/discover/gm)) {
        $("#discover").removeClass("hidden");
      } else {
        // $('.other-issuer').removeClass('hidden');
        // $('.other-issuer').text(scheme);
      }
    });
  }

  if (id == "last4" && TXN.user_details.last4.length != 4) {
    $("#last4").css("border-color", "red");
  } else if (id == "last4" && TXN.user_details.last4.length == 4) {
    $("#last4").css("border-color", "rgba(0,0,0,0.5)");
  }

  MODAL.checkFields();
});

$(".modal-track-order .modal-txn-user-details input[type=date]").change(
  function () {
    let id = $(this).attr("id");
    TXN.user_details[id] = $(this).val();

    MODAL.checkFields();
  }
);

$(".modal-track-membership .modal-txn-user-details input").keyup(function () {
  let id = $(this).attr("id");
  id = id.replace(/member_/, "");

  TXN.user_details[id] = $(this).val();

  if (id == "first6" && TXN.user_details.first6.length != 6) {
    $(".issuer-icon").addClass("hidden");
    $("#member_first6").css("border-color", "red");
  } else if (id == "first6" && TXN.user_details.first6.length == 6) {
    $("#member_first6").css("border-color", "rgba(0,0,0,0.5)");

    $.when(
      ajax({ url: `https://lookup.binlist.net/${TXN.user_details.first6}` })
    ).then((e) => {
      let scheme = e.scheme;

      if (scheme.match(/visa/gm)) {
        $("#visa").removeClass("hidden");
      } else if (scheme.match(/mastercard/gm)) {
        $("#mastercard").removeClass("hidden");
      } else if (scheme.match(/amex/gm)) {
        $("#amex").removeClass("hidden");
      } else if (scheme.match(/discover/gm)) {
        $("#discover").removeClass("hidden");
      } else {
        // $('.other-issuer').removeClass('hidden');
        // $('.other-issuer').text(scheme);
      }
    });
  }

  if (id == "last4" && TXN.user_details.last4.length != 4) {
    $("#member_last4").css("border-color", "red");
  } else if (id == "last4" && TXN.user_details.last4.length == 4) {
    $("#member_last4").css("border-color", "rgba(0,0,0,0.5)");
  }

  if (
    TXN.user_details.order_no &&
    TXN.user_details.first6 &&
    TXN.user_details.first6.length == 6 &&
    TXN.user_details.last4 &&
    TXN.user_details.last4.length == 4 &&
    TXN.user_details.firstname &&
    TXN.user_details.lastname &&
    TXN.user_details.email_address &&
    TXN.user_details.time &&
    TXN.user_details.amount
  ) {
    TXN.user_details.first_name = TXN.user_details.firstname;
    TXN.user_details.last_name = TXN.user_details.lastname;
    $(".modal-track").attr("disabled", false);
  } else {
    $(".modal-track").attr("disabled", true);
  }
});

$(".modal-track-membership .modal-txn-user-details input[type=date]").change(
  function () {
    let id = $(this).attr("id");
    id = id.replace(/member_/, "");

    TXN.user_details[id] = $(this).val();

    if (
      TXN.user_details.order_no &&
      TXN.user_details.first6 &&
      TXN.user_details.first6.length == 6 &&
      TXN.user_details.last4 &&
      TXN.user_details.last4.length == 4 &&
      TXN.user_details.firstname &&
      TXN.user_details.lastname &&
      TXN.user_details.email_address &&
      TXN.user_details.time &&
      TXN.user_details.amount
    ) {
      TXN.user_details.first_name = TXN.user_details.firstname;
      TXN.user_details.last_name = TXN.user_details.lastname;
      $(".modal-track").attr("disabled", false);
    } else {
      $(".modal-track").attr("disabled", true);
    }
  }
);

$(".modal-txn-user-details input").keypress(function (e) {
  let id = $(this).attr("id");
  id = id.replace(/member_/g, "");

  if ($(this).val().length >= 6 && id == "first6") e.preventDefault();

  if ($(this).val().length >= 4 && id == "last4") e.preventDefault();
});

$(".modal-next").click(function (e) {
  e.preventDefault();

  if (Object.keys(TXN.result).length || TXN.result == "not-found") {
    MODAL.final(3);
    return;
  }

  MODAL.track_order_2();
});

$(".modal-track").click(function (e) {
  e.preventDefault();
  MODAL.track_now();
});

$(".modal-cancel-member").click(function (e) {
  e.preventDefault();

  TXN.confirmCancellation().then((e) => {
    if (!e) return;

    MODAL.cancelSsubscription();
  });
});

$(".modal-refund").click(function () {
  TXN.refund();
});

$(".modal-close").click(function () {
  MODAL.close();
});

$(".modal-chat").click(function (e) {
  e.preventDefault();

  $(".open-chat-box").click();
});

$(".modal-email").click(function (e) {
  e.preventDefault();

  window.location = "../contact-us.php";
});

$(".modal").click(function (e) {
  let target = $(e.target);

  if (target.hasClass("descriptor_key")) {
    $(".results li:not(.skeleton)").removeClass("hidden");
  } else {
    $(".results li:not(.skeleton)").addClass("hidden");
  }
});

$("#error-ok").click(function (e) {
  e.preventDefault();

  $(".modal-request-error").fadeOut();
  setTimeout(() => {
    MODAL.close();
  }, 400);
});

///////////// TRANSACTION

const TXN = {
  result: {},

  user_details: {
    order_no: "",
    first6: "",
    last4: "",
    firstname: "",
    first_name: "",
    lastname: "",
    last_name: "",
    time: "",
    amount: "",
    email_address: "",
  },

  search: (params) => {
    return ajax({
      url: API_ENDPOINT,
      params: params,
      bfs: () => {
        $(".modal-body-part").addClass("hidden");
        $(".modal-track-result:not(.proc-api)").removeClass("hidden");
        $(".footer-buttons").addClass("hidden");
        $(".modal-track-result").scrollTop(0);

        if (helpOpt == 3) {
          $(".modal-shipping").removeClass("hidden");
          $(".modal-txn-info").addClass("hidden");
        }

        if (helpOpt == 4 || helpOpt == 5) {
          // $('.modal-shipping').addClass('hidden');
          $(".modal-txn-info").removeClass("hidden");
        }
      },
      err: () => {
        $(".modal-request-error").fadeIn();
      },
    });
  },

  confirmCancellation: async () => {
    $(".modal-confirm-cancellation").fadeIn();

    return new Promise((resolve) => {
      $("#cancel-member-yes").click(function (e) {
        e.preventDefault();

        $(".modal-confirm-cancellation").fadeOut();
        resolve(1);
      });

      $("#cancel-member-no").click(function (e) {
        e.preventDefault();

        $(".modal-confirm-cancellation").fadeOut();
        resolve(0);
      });
    });
  },

  cancelSubscription: (params) => {
    return ajax({
      url: API_ENDPOINT,
      params: params,
      bfs: () => {
        $(".modal-body-part").addClass("hidden");
        $(".modal-cancellation-request").removeClass("hidden");
        $(".footer-buttons").addClass("hidden");
      },
      err: () => {
        $(".modal-request-error").fadeIn();
      },
    });
  },

  refund: () => {
    let txn = TXN.user_details;
    let txn_res = ORDER_SELECTION.selected;
    // let date_settled = txn_res.action ? txn_res.action.date : null;
    // if (date_settled) {
    //     date_settled = date_settled.substring(0, 4) + '-' + date_settled.substring(4, 6) + '-' + date_settled.substring(6, 8);
    //     date_settled = new Date(date_settled);
    //     date_settled = date_settled.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    // } else
    //     date_settled = '';

    if (DESCRIPTOR.PROC_API()) {
      txn.first6 = txn.first6
        ? txn.first6
        : txn_res.first6
        ? txn_res.first6
        : "";
      txn.last4 = txn.last4 ? txn.last4 : txn_res.last4 ? txn_res.last4 : "";
      txn.date_purchased = txn.time
        ? txn.time
        : txn_res.time
        ? txn_res.time
        : "";
      txn.amount = txn.amount
        ? txn.amount
        : txn_res.amount
        ? txn_res.amount
        : "";
      txn.email_address = txn.email_address
        ? txn.email_address
        : txn_res.email
        ? txn_res.email
        : "";
      txn.firstname = txn.firstname
        ? txn.firstname
        : txn_res.firstname
        ? txn_res.firstname
        : "";
      txn.lastname = txn.lastname
        ? txn.lastname
        : txn_res.lastname
        ? txn_res.lastname
        : "";
      txn.order_no = txn.order_no
        ? txn.order_no
        : txn_res.transactionid
        ? txn_res.transactionid
        : "";
      delete txn.time;
      delete txn.time;
    } else {
      txn.first6 = txn.first6
        ? txn.first6
        : txn_res.cc_bin
        ? txn_res.cc_bin
        : "";
      txn.date_purchased = txn.time
        ? txn.time
        : txn_res.action
        ? txn_res.action.date.substring(0, 4) +
          "-" +
          txn_res.action.date.substring(4, 6) +
          "-" +
          txn_res.action.date.substring(6, 8)
        : "";
      txn.amount = txn.amount
        ? txn.amount
        : txn_res.action
        ? txn_res.action.amount
        : "";
      txn.email_address = txn.email_address
        ? txn.email_address
        : txn_res.email
        ? txn_res.email
        : "";
      txn.firstname = txn.firstname
        ? txn.firstname
        : txn_res.first_name
        ? txn_res.first_name
        : "";
      txn.lastname = txn.lastname
        ? txn.lastname
        : txn_res.last_name
        ? txn_res.last_name
        : "";
      txn.order_no = txn.order_no
        ? txn.order_no
        : txn_res.order_id
        ? txn_res.order_id
        : "";
      delete txn.time;
    }

    let refund_link = "refund";
    let qry = "";
    for (let i in TXN.user_details) {
      qry += `${i}=${TXN.user_details[i]}&`;
    }
    qry += `descriptor=${DESCRIPTOR.selected.descriptor_text}`;
    window.location = refund_link + "?" + qry + "&opt=" + helpOpt;
  },
};

/////////////// DESCRIPTOR AND SEARCH MODAL

const DESCRIPTOR = {
  modal: {
    init: () => {
      descriptor_search.fadeIn();
    },

    get_selected: async () => {
      return new Promise((resolve) => {
        $("#modal-descriptor-close").click(function (e) {
          e.preventDefault();
          DESCRIPTOR.modal.close();
          DESCRIPTOR.modal.clear();
          resolve(null);
        });

        $("#search-descriptor-next").click(function (e) {
          e.preventDefault();
          DESCRIPTOR.modal.close();
          DESCRIPTOR.modal.clear();
          resolve(DESCRIPTOR.selected);
        });
      });
    },

    close: () => {
      descriptor_search.fadeOut();
      DESCRIPTOR.clear_results();
      DESCRIPTOR.modal.clear();
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
        err: () => {
          $(".modal-request-error").fadeIn();
        },
      })
    ).done((e) => {
      if (!parseResponse(e)) return;

      // e = e.responsedetails;

      skeleton.toggleClass("hidden");

      DESCRIPTOR.results = e;

      let result = $(".descriptor-searchfield ul.results");

      if (!e.length) {
        result.append(`
                    <div style="background-color: #fafafa; padding: 12px; font-size: 13px; color: red; font-weight: 700;">The merchant is not a member, if you'd like us to contact the merchant on your behalf about getting you a refund, please <a style="color: #072a48; text-decoration: underline;" href="https://www.ican4consumers.net/access/merchants-contact-information?merchant=${params.descriptor}">click here</a>.</div>
                `);
        return;
      }
      for (let m of e) {
        result.append(`
                    <li>${m.descriptor_text}</li>
                `);
      }
    });
  },

  clear_results: () => {
    $(".descriptor-searchfield li:not(.skeleton)").remove();
    $(".descriptor-searchfield div").remove();
    DESCRIPTOR.results = {};
  },

  check_process_type: () => {
    const PROCESS_TYPES = ["FORWARDING", "BATCH-FILE", "ORR2", "UPLOAD"];

    if (
      PROCESS_TYPES.includes(DESCRIPTOR.selected.process_type.toUpperCase())
    ) {
      $(".modal-redirection-alert").fadeIn();
      setTimeout(() => {
        TXN.refund();
      }, 3000);
      return 0;
    }

    return 1;
  },

  PROC_API: () => {
    const apis = ["API", "API2", "API3"];

    return apis.includes(DESCRIPTOR.selected.process_type.toUpperCase());
  },

  results: {},

  selected: [],
};

$(".descriptor_key").keyup(
  debounce(function (e) {
    DESCRIPTOR.clear_results();
    DESCRIPTOR.selected = [];
    $(".txn-detail").attr("disabled", true);

    const _this = $(".descriptor_key");

    if ($(this).val().length < 5) return;

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

  console.log(DESCRIPTOR.selected);
  let req = JSON.parse(DESCRIPTOR.selected.request_requirements) ?? [];

  // if (req) {
  req.filter((e) => {
    e.name = "orderId";
  });
  if (req.length) {
    $("#order_no, .divider").removeClass("hidden");
  } else {
    $("#order_no, .divider").addClass("hidden");
  }
  // }

  $(".descriptor-searchfield .descriptor_key").val(descriptor);
  $("#search-descriptor-next").attr("disabled", false);
  $(".modal-txn-user-details input").attr("disabled", false);
});

//////////////// ORDER SELECTION

const ORDER_SELECTION = {
  init: () => {
    $(".modal-multiple-txn").fadeIn();
    $(".order-selection-select").attr("disabled", true);

    let cards = $(".txn-card");

    for (let i in cards) {
      if (typeof cards[i] != "object") return;

      $(cards[i]).css({
        opacity: 0,
        transform: "translateY(100px)",
      });

      setTimeout(() => {
        $(cards[i]).animate(
          {
            opacity: 1,
            transform: 100,
          },
          {
            step: () => {
              $(cards[i]).css({ transform: "translateY(0)" });
            },
          }
        );
      }, 400 + 100 * i);
    }
  },

  selected: {},

  getSelection: async () => {
    return new Promise((resolve) => {
      $(".order-selection-cancel").click(function (e) {
        e.preventDefault();
        ORDER_SELECTION.close();
        resolve(null);
      });

      $(".order-selection-select").click(function (e) {
        e.preventDefault();
        ORDER_SELECTION.close();
        resolve(ORDER_SELECTION.selected);
      });
    });
  },

  scroll: (parent, delayed = true) => {
    setTimeout(
      () => {
        let offsetTop = $(".modal-multiple-txn-body .info").height();
        let index = parent.index();
        let cards = $(".txn-card");

        for (i = 0; i <= index; i++) {
          offsetTop += $(cards[i]).outerHeight(true);
        }

        $(".modal-multiple-txn-body").animate(
          {
            scrollTop: offsetTop - parent.height() + 15,
          },
          400
        );
      },
      delayed ? 400 : 0
    );
  },

  close: () => {
    $(".txn-card").remove();
    $(".modal-multiple-txn").fadeOut();
  },
};

$(document).on("click", ".txn-card", function (e) {
  if ($(e.target).hasClass("card-button")) return;

  let id = $(this).attr("id");

  $(".txn-card .radio i:first-child").removeClass("hidden");
  $(".txn-card .radio i:last-child").addClass("hidden");

  $(this).find(".radio i:first-child").addClass("hidden");
  $(this).find(".radio i:last-child").removeClass("hidden");

  $(".order-selection-select").attr("disabled", false);

  if (DESCRIPTOR.PROC_API())
    ORDER_SELECTION.selected = TXN.result.find((e) => e.transactionid == id);
  else
    ORDER_SELECTION.selected = TXN.result.find((e) => e.transaction_id == id);
});

$(document).on("click", ".more-details", function (e) {
  let parent = $(this).closest(".txn-card");

  $(this).addClass("hidden");
  parent.find(".hide-details").removeClass("hidden");
  parent.find(".other-details").addClass("show");

  ORDER_SELECTION.scroll(parent);
});

$(document).on("click", ".hide-details", function (e) {
  let parent = $(this).closest(".txn-card");

  $(this).addClass("hidden");
  parent.find(".more-details").removeClass("hidden");
  parent.find(".other-details").removeClass("show");

  ORDER_SELECTION.scroll(parent, false);
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
    error: (x, t, r) => {
      console.log(x);
      console.log(t);
      console.log(r);
      err();
    },
    timeout: 10000,
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

function parseResponse(e) {
  if (typeof e != "object") {
    try {
      e = JSON.parse(e);
    } catch {
      MODAL.errorRequest();
      return 0;
    }
  }

  return e;
}

function validateEmail(email) {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

const subscriptionModal = $('#subscription-modal');
const cancelModal = $('#confirm-cancel');
const cancelledModal = $('#subscription-cancelled');
const viewport = $(".viewport");
const closeSubscriptionButton = $('#close-subscription');
const cancelSubButton = $('.cancel-sub-btn');
const cancelCancellationButton = $('#cancel-cancellation');
const confirmCancellationButton = $('#confirm-cancellation');
const closeSuccessCancellationButton = $('#close-success-cancellation');
const refundRequestModalButton = $('#subscription-refund-request-modal');
const modalTrackButtons = $('.modal-track');
const subscriptionModalClose = $('.subscription-modal-close');

var mid;

const SUBSCRIPTION_MODAL = {
    init() {
        const urlParams = new URLSearchParams(window.location.search);
        mid = urlParams.get('mid');
        const cid = urlParams.get('cid');
        const email = urlParams.get('email');

        if (mid && (cid || email)) {
            subscriptionModal.fadeIn();
            const newUrl = `${window.location.origin}${window.location.pathname}`;
            history.replaceState(null, '', newUrl);
        }
    },
    slide(index) {
        viewport.attr('class', 'viewport').addClass(`s${index}`);
        $('.subscription-modal-next').hide();
        subscriptionModalClose.removeClass('hidden');
    },
};

function generateReceiptNumbers(count = 5, min = 100000, max = 999999) {
    return Array.from({ length: count }, () =>
        Math.floor(Math.random() * (max - min + 1)) + min
    );
}

function copyToClipboard(spanId) {
    const span = document.getElementById(spanId);
    if (span) {
        const valueToCopy = span.textContent || span.innerText;
        navigator.clipboard.writeText(valueToCopy)
            .then(() => {
                const button = document.querySelector(`button[onclick="copyToClipboard('${spanId}')"]`);
                if (button) {
                    button.setAttribute("data-tooltip", "Copied");
                    setTimeout(() => button.removeAttribute("data-tooltip"), 2000);
                }
            })
            .catch(err => console.error("Failed to copy text: ", err));
    } else {
        console.error(`Element with id '${spanId}' not found.`);
    }
}

$(document).ready(() => {
    SUBSCRIPTION_MODAL.init();

    closeSubscriptionButton.on('click', () => subscriptionModal.fadeOut());
    cancelCancellationButton.on('click', () => cancelModal.fadeOut());
    closeSuccessCancellationButton.on('click', () => cancelledModal.fadeOut());

    refundRequestModalButton.on('click', () => {

        $.ajax({
            url: 'home/refund_request',
            type: 'POST',
            data: {},
            success: function (response) {
                console.log('Subscription cancelled:', response);

                // setTimeout(() => {
                //     $('.slide2Text').removeClass('hidden');
                //     $('.slide-2 .loading-ring').addClass('hidden');
                //     $('#slide2TRN').text(`${generateReceiptNumbers(1)}`);
                // }, 1200);
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: "Failed to cancel the subscription. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });

        SUBSCRIPTION_MODAL.slide(3);
        setTimeout(() => {
            // $('.slide3Text').removeClass('hidden');
            // $('.slide-3 .loading-ring').addClass('hidden');
            // $('#slide3TRN').text(` ${generateReceiptNumbers(1)}`);
        }, 1200);
    });

    modalTrackButtons.on('click', function () {
        let subscriptionId = $(this).data('subscriptionid');

        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to cancel your subscription?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#eee",
            confirmButtonText: "Proceed to Cancel",
            cancelButtonText: "Close"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#slide2').removeClass('hidden');
                SUBSCRIPTION_MODAL.slide(2);
                
                setTimeout(() => {
                    setTimeout(() => {
                        $('.slide2Text').removeClass('hidden');
                        $('.slide-2 .loading-ring').addClass('hidden');
                        $('#slide2TRN').text(`${generateReceiptNumbers(1)}`);
                    }, 1200);
                    $.ajax({
                        url: 'home/cancel_subscription',
                        type: 'POST',
                        data: { subscriptionId: subscriptionId },
                        success: function (response) {
                            var result = JSON.parse(response);
                            console.log('Subscription cancelled:', result['Status']);

                            setTimeout(() => {
                                $('.slide2Text').removeClass('hidden');
                                $('.slide-2 .loading-ring').addClass('hidden');
                                $('#slide2TRN').text(`${generateReceiptNumbers(1)}`);
                            }, 1200);
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                title: "Error",
                                text: "Failed to cancel the subscription. Please try again.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                }, 1000);
            }
        });
    });

    subscriptionModalClose.on('click', () => subscriptionModal.fadeOut());
});

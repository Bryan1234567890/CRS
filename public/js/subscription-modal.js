const subscriptionModal = $('#subscription-modal');
const viewport = $(".viewport");
const subscriptionModalClose = $('.subscription-modal-close');
const refundRequestModalButton = $('#subscription-refund-request-modal');

let mid, email, first6, last4;

const SUBSCRIPTION_MODAL = {
    init() {
        const urlParams = new URLSearchParams(window.location.search);
        mid = urlParams.get('mid');
        email = urlParams.get('email');
        const cid = urlParams.get('cid');
        first6 = urlParams.get('first6');
        last4 = urlParams.get('last4');

        if (mid || (email || cid) || first6 || last4) {
            email = email || cid;
            subscriptionModal.fadeIn();

            if (!email || !first6 || !last4) {
                SUBSCRIPTION_MODAL.showInputSlide();
                return;
            }

            SUBSCRIPTION_MODAL.loadDetails();
        }
    },

    showInputSlide() {
        let html = '<div class="subscription-modal-body-part subscription-modal-track-order" style="padding: 20px;">';
        html += '<h4>For verification, please provide the following information:</h4>';

        if (!email) {
            html += '<div class="dual-input"><label>Email</label><input type="email" id="input-email" class="input-field" placeholder="" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$" /></div>';
        }
        if (!first6) {
            html += '<div class="dual-input"><label>First 6 digits of card</label><input type="text" id="input-first6" class="input-field" maxlength="6" placeholder="" /></div>';
        }
        if (!last4) {
            html += '<div class="dual-input"><label>Last 4 digits of card</label><input type="text" id="input-last4" class="input-field" maxlength="4" placeholder="" /></div>';
        }

        html += '<div style="text-align: right; margin-top: 20px;">';
        html += '<button class="opt-button" id="submit-subscription-info" style="background-color:#2d98da; color: #fff;">Continue</button>';
        html += '</div></div>';

        if (!$('.slide-0').length) {
            $('.slides').prepend('<div class="slide slide-0"></div>');
        }

        $('.slide-0').html(html);
        SUBSCRIPTION_MODAL.slide(0);
    },

    loadDetails() {
        $.ajax({
            url: 'home/getDetails',
            type: 'POST',
            data: { mid, email, first6, last4 },
            beforeSend: function () {
                SUBSCRIPTION_MODAL.slide(1);
                $('#subscription-details').html(`
                    <div class="generic-loader" style="text-align: center; padding: 50px;">
                        <div class="loading-ring" style="
                            border: 4px solid #f3f3f3;
                            border-top: 4px solid #3498db;
                            border-radius: 50%;
                            width: 40px;
                            height: 40px;
                            animation: spin 1s linear infinite;
                            margin: 0 auto;
                        "></div>
                        <p style="margin-top: 15px;">Loading your subscriptions...</p>
                    </div>
                `);
            },
            
            success: function (response) {
                const res = typeof response === 'string' ? JSON.parse(response) : response;
                if (res.response_code === '200') {
                    SUBSCRIPTION_MODAL.renderDetails(res);
                    SUBSCRIPTION_MODAL.slide(1);
                    const newUrl = `${window.location.origin}${window.location.pathname}`;
                    history.replaceState(null, '', newUrl);
                } else {
                    $('#subscription-details').html(`<div style="text-align:center; color:red;">${res.message.message ?? "Unknow Error."}.</div>`);
                    SUBSCRIPTION_MODAL.slide(1);
                }
            },
            error: function (err) {
                console.log("err",err);
                $('#subscription-details').html('<div style="text-align:center; padding: 30px; color:red;">Error loading subscription data.</div>');
                SUBSCRIPTION_MODAL.slide(1);
            }
        });
    },

    renderDetails(data) {
        const subscriptions = data.data || {};
        let html = '';
        let activeCount = 0;

        const merchantName = subscriptions.website_address
        ? subscriptions.website_address.toUpperCase()
        : 'Unknown Merchant';
        delete subscriptions.website_address;

        html += `<h4 style="margin-bottom: 10px;"><strong>Merchant:</strong> ${merchantName}</h4>`;
        html += `<p>Subscription details:</p>`;

        const subscriptionKeys = Object.keys(subscriptions);
        if (subscriptionKeys.length === 0) {
            html += `<strong>No active subscriptions found.</strong>`;
            $('#subscription-details').html(html);
            return;
        }

        subscriptionKeys.forEach((key) => {
            const subData = subscriptions[key];
            const subscription = subData?.subscription;

            if (!subscription) return;

            const name = subscription.name || 'N/A';
            const card = subscription.profile?.paymentProfile?.payment?.creditCard?.cardNumber || '****';
            const amount = subscription.amount || '0.00';
            const intervalData = subscription.paymentSchedule?.interval || {};
            const intervalUnit = intervalData.unit || 'months';
            const intervalLength = intervalData.length ?? 1;
            const status = subscription.status || 'unknown';

            let intervalLabel = '';
            if (intervalUnit === 'months') {
                if (intervalLength === 1) {
                    intervalLabel = 'Monthly';
                } else if (intervalLength === 0) {
                    intervalLabel = 'One-time';
                } else {
                    intervalLabel = `Every ${intervalLength} Months`;
                }
            }

            if (status.toLowerCase() === 'active') {
                activeCount++;
                html += `
                    <div class="subscription-modal-txn-user-details">
                        <div class="dual-input">
                            <div>
                                <span class="placeholder">${name} ${card}</span>
                                <p>${intervalLabel}</p>
                            </div>
                            <p>$ ${amount}</p>
                        </div>
                        <div class="dual-input">
                            <p></p>
                            <button class="opt-button modal-track footer-buttons glowblue"
                                    style="background-color:#fa8231; color: #f8f8f8;" 
                                    data-subscriptionid="${key}">
                                Cancel Subscription
                            </button>
                        </div>
                    </div>
                `;
            }
        });

        if (activeCount === 0) {
            html += `<strong>No active subscriptions found.</strong>`;
        }

        $('#subscription-details').html(html);
    },

    slide(index) {
        const classList = viewport.attr('class').split(' ').filter(c => !/^s\d+$/.test(c));
        classList.push(`s${index}`);
        viewport.attr('class', classList.join(' '));

        $('.subscription-modal-next').hide();
        subscriptionModalClose.removeClass('hidden');
    }
};

function generateReceiptNumbers(count = 1, min = 100000, max = 999999) {
    return Array.from({ length: count }, () =>
        Math.floor(Math.random() * (max - min + 1)) + min
    );
}

function copyToClipboard(spanId) {
    const span = document.getElementById(spanId);
    if (span) {
        const valueToCopy = span.textContent || span.innerText;
        navigator.clipboard.writeText(valueToCopy).then(() => {
            const button = document.querySelector(`button[onclick="copyToClipboard('${spanId}')"]`);
            if (button) {
                button.setAttribute("data-tooltip", "Copied");
                setTimeout(() => button.removeAttribute("data-tooltip"), 2000);
            }
        });
    }
}

$(document).ready(() => {
    SUBSCRIPTION_MODAL.init();

    $(document).on('click', '.modal-track', function () {
        let subscriptionId = $(this).data('subscriptionid');
    
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to cancel your subscription?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed to Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#slide2').removeClass('hidden');
                SUBSCRIPTION_MODAL.slide(2);
    
                setTimeout(() => {
                    
                    $.ajax({
                        url: 'home/cancel_subscription',
                        type: 'POST',
                        data: { subscriptionId },
                        success: function (response) {
                            const res = typeof response === 'string' ? JSON.parse(response) : response;
                        
                            if (res.response_code === "200") {
                                   // Slide already changed by SUBSCRIPTION_MODAL.slide(2), just unhide internals
                                $('#slide2').removeClass('hidden');
                                $('.slide2Text').removeClass('hidden');
                                $('.slide-2 .loading-ring').addClass('hidden');
                        
                                const message = res.data || 'Subscription Cancelled';
                                $('#slide2TRN').text(`${response.data.transactionid}`);
                            } else {
                                Swal.fire("Error", res.message || "Failed to cancel the subscription.", "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error", "Failed to cancel the subscription.", "error");
                        }
                    });
                    
                }, 1000);
            }
        });
    });
    

    refundRequestModalButton.on('click', () => {
        $.ajax({
            url: 'home/refund_request',
            type: 'POST',
            success: function () {
                SUBSCRIPTION_MODAL.slide(3);
                setTimeout(() => {
                    $('.slide3Text').removeClass('hidden');
                    $('.slide-3 .loading-ring').addClass('hidden');
                    $('#slide3TRN').text(`${generateReceiptNumbers(1)}`);
                }, 1200);
            },
            error: function () {
                Swal.fire("Error", "Failed to request a refund.", "error");
            }
        });
    });

    subscriptionModalClose.on('click', () => subscriptionModal.fadeOut());

    $(document).on('click', '#submit-subscription-info', () => {
        const emailInput = $('#input-email');
        const first6Input = $('#input-first6');
        const last4Input = $('#input-last4');
    
        let isValid = true;
    
        if (!email && emailInput.length) {
            const val = emailInput.val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!val || !emailRegex.test(val)) {
                isValid = false;
                emailInput.css('border-color', 'red');
            } else {
                email = val;
                emailInput.css('border-color', '');
            }
        }
    
        if (!first6 && first6Input.length) {
            const val = first6Input.val().trim();
            if (!val || val.length !== 6 || !/^\d{6}$/.test(val)) {
                isValid = false;
                first6Input.css('border-color', 'red');
            } else {
                first6 = val;
                first6Input.css('border-color', '');
            }
        }
    
        if (!last4 && last4Input.length) {
            const val = last4Input.val().trim();
            if (!val || val.length !== 4 || !/^\d{4}$/.test(val)) {
                isValid = false;
                last4Input.css('border-color', 'red');
            } else {
                last4 = val;
                last4Input.css('border-color', '');
            }
        }

        if (!isValid) return;

    
        SUBSCRIPTION_MODAL.loadDetails();
    });
    
});

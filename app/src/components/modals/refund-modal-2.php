<div class="refund-modal" id="refundModal">
    <div class="refund-modal-inner">
        <div class="refund-modal-head">
            <i class="fa fa-times refund-modal-close"></i>
        </div>

        <div class="refund-modal-body">
            <div class="viewport s1">
                <div class="slides">
                    <div class="slide slide-1">
                        <div class="refund-modal-body-part refund-modal-init">
                            <h3>How may I help you today?</h3>
                            <div class="select">
                                <i class="fa fa-sort-down"></i>
                                <select name="help-select" id="help-select">
                                    <option value="1">I have a question about my purchase.</option>
                                    <option value="2">I don't know how to use the product I purchased.</option>
                                    <option value="3">I didn't receive what I ordered.</option>
                                    <option value="4">I don't recognize this purchase.</option>
                                    <option value="5">I want to cancel my membership.</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="slide slide-2">
                        <div class="refund-modal-body-part refund-modal-track-order hidden">
                            <div class="descriptor-searchfield">
                                <p>What website did you buy the product or service or what descriptor appears on
                                    your card statement?</p>
                                <input type="text" class="descriptor_key" placeholder="Website / Descriptor ">
                                <ul class="results">
                                    <li class="skeleton hidden"><i>Searching...</i></li>
                                </ul>
                            </div>
                            <div class="refund-modal-txn-user-details">
                                <input class="txn-detail" type="text" name="order_no" id="order_no" placeholder="Order No." disabled="">
                                <p class="divider">Or</p>
                                <p class="subtitle">*All fields below are required.</p>
                                <div class="dual-input">
                                    <img src="https://www.ican4consumers.com/public/images/visa.png" alt="" class="issuer-icon hidden" id="visa">
                                    <img src="https://www.ican4consumers.com/public/images/mastercard.png" alt="" class="issuer-icon hidden" id="mastercard">
                                    <img src="https://www.ican4consumers.com/public/images/amex.png" alt="" class="issuer-icon hidden" id="amex">
                                    <img src="https://www.ican4consumers.com/public/images/discover.png" alt="" class="issuer-icon hidden" id="discover">
                                    <input class="txn-detail" type="number" name="first6" id="first6" placeholder="First 6 Card Digit" max="999999" disabled="">
                                    <input class="txn-detail" type="number" name="last4" id="last4" placeholder="Last 4 Card Digit" max="9999" disabled="">
                                </div>
                                <div class="dual-input">
                                    <input class="txn-detail" type="text" name="firstname" id="firstname" placeholder="Firstname" disabled="" autocomplete="off">
                                    <input class="txn-detail" type="text" name="lastname" id="lastname" placeholder="Lastname" disabled="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="refund-modal-body-part refund-modal-track-membership hidden">
                            <div class="descriptor-searchfield">
                                <p>What website did you buy the product or service or what descriptor appears on
                                    your card statement?</p>
                                <input type="text" class="descriptor_key" placeholder="Website / Descriptor ">
                                <ul class="results">
                                    <li class="skeleton hidden"><i>Searching...</i></li>
                                </ul>
                            </div>
                            <div class="refund-modal-txn-user-details">
                                <p class="subtitle">*All fields below are required.</p>
                                <div class="dual-input">
                                    <input class="txn-detail" type="number" name="order_no" id="member_order_no" placeholder="Order Number" disabled="">
                                    <input class="txn-detail" type="email" name="email_address" id="member_email_address" placeholder="Email address" disabled="">
                                </div>
                                <div class="dual-input">
                                    <img src="https://www.ican4consumers.com/public/images/visa.png" alt="" class="issuer-icon hidden">
                                    <img src="https://www.ican4consumers.com/public/images/mastercard.png" alt="" class="issuer-icon hidden">
                                    <img src="https://www.ican4consumers.com/public/images/amex.png" alt="" class="issuer-icon hidden">
                                    <img src="https://www.ican4consumers.com/public/images/discover.png" alt="" class="issuer-icon hidden">
                                    <input class="txn-detail" type="number" name="first6" id="member_first6" placeholder="First 6 Card Digit" max="999999" disabled="">
                                    <input class="txn-detail" type="number" name="last4" id="member_last4" placeholder="Last 4 Card Digit" max="9999" disabled="">
                                </div>
                                <div class="dual-input">
                                    <input class="txn-detail" type="text" name="firstname" id="member_firstname" placeholder="Firstname" disabled="" autocomplete="off">
                                    <input class="txn-detail" type="text" name="lastname" id="member_lastname" placeholder="Lastname" disabled="" autocomplete="off">
                                </div>
                                <div class="dual-input">
                                    <input class="txn-detail" type="text" name="amount" id="member_amount" placeholder="Amount" disabled="" autocomplete="off">
                                    <div class="date-picker">
                                        <input class="txn-detail" type="date" name="time" id="member_time" placeholder="Date of Purchase" disabled="" autocomplete="off" required="">
                                        <span class="placeholder">Date of Purchase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slide slide-3">
                        <div class="refund-modal-body-part refund-modal-track-order part2 hidden">
                            <div class="refund-modal-txn-user-details">
                                <p>Date of Purchase</p>
                                <input class="txn-detail" type="date" name="time" id="time" placeholder="Date of purchase" disabled="">
                                <div class="dual-input">
                                    <input class="txn-detail" type="text" name="email_address" id="email_address" placeholder="Email address" disabled="" autocomplete="off">
                                    <input class="txn-detail" type="number" name="amount" id="amount" placeholder="Amount of purchase (USD)" disabled="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slide slide-4">
                        <div class="refund-modal-body-part refund-modal-track-result hidden">
                            <div class="refund-modal-track-result-head refund-modal-shipping">
                                <span class="track-result-skeleton"></span>
                                <span class="track-result-skeleton"></span>
                                <h3 class="hidden">Your order was <span class="ship_stat">STATUS</span> on <span class="ship_date">DATE</span> via <span class="courier">COURIER</span>.
                                </h3>
                                <p class="hidden">Tracking Number: <span class="tracking_no">TRACKING NO</span>
                                </p>
                            </div>

                            <div class="refund-modal-track-result-item">
                                <div class="head">
                                    <h4>Product</h4>
                                </div>
                                <div class="item-info">
                                    <p>Product Name:</p>
                                    <p class="product_name item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Date Settled:</p>
                                    <p class="date_settled item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Order Number:</p>
                                    <p class="order_number item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                            </div>

                            <div class="refund-modal-track-result-item">
                                <div class="head">
                                    <h4>Payment</h4>
                                </div>
                                <div class="item-info">
                                    <p>Amount:</p>
                                    <p class="amount item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Card Type:</p>
                                    <p class="card_type item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Card First 6 Digit:</p>
                                    <p class="first6_result item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                            </div>

                            <div class="refund-modal-track-result-item">
                                <div class="head">
                                    <h4>Customer's Information</h4>
                                </div>
                                <div class="item-info">
                                    <p>Name:</p>
                                    <p class="name item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Address:</p>
                                    <p class="address item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Email Address:</p>
                                    <p class="email_address item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                            </div>

                            <div class="refund-modal-track-result-item shipping">
                                <div class="head">
                                    <h4>Shipping Information</h4>
                                </div>
                                <div class="item-info">
                                    <p>Name:</p>
                                    <p class="shipping_name item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Tracking No:</p>
                                    <p class="tracking_no item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Address:</p>
                                    <p class="shipping_address item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                            </div>
                        </div>

                        <div class="refund-modal-body-part refund-modal-track-result proc-api hidden">
                            <div class="refund-modal-track-result-head refund-modal-txn-info">
                                <h2>Your Transaction Info:</h2>
                            </div>

                            <div class="refund-modal-track-result-item">
                                <div class="item-info">
                                    <p>ID:</p>
                                    <p class="txn-id product_name item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Customer Name:</p>
                                    <p class="txn-name product_name item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Customer Email:</p>
                                    <p class="txn-email item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>First 6 Card Number:</p>
                                    <p class="txn-first-6 item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Last 4 Card Number:</p>
                                    <p class="txn-last-4 item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Amount:</p>
                                    <p class="txn-amount item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div class="item-info">
                                    <p>Date or purchase:</p>
                                    <p class="txn-date item-info-text-result"></p>
                                    <span class="track-result-skeleton"></span>
                                </div>
                            </div>
                        </div>

                        <div class="refund-modal-body-part refund-modal-not-found hidden">
                            <h4>The transaction/subscription based on the information you provided was not
                                found.
                                You may try the other option.</h4>
                            <img src="https://www.ican4consumers.com/public/images/no-data.jpg" alt="">
                        </div>
                    </div>

                    <div class="slide slide-5">
                        <div class="refund-modal-body-part refund-modal-cancellation-request hidden">
                            <div class="inner hidden">
                                <h3>Thank you!</h3>
                                <p class="cancellation-request-result"></p>
                                <p>Questions? Call us Toll Free <span>(855) 660-3214</span> or email
                                    <span>support@iCan4Consumers.com</span>
                                </p>
                            </div>

                            <div class="inner skeleton">
                                <span class="track-result-skeleton"></span>
                                <div>
                                    <span class="track-result-skeleton"></span>
                                    <span class="track-result-skeleton"></span>
                                    <span class="track-result-skeleton"></span>
                                </div>
                                <div>
                                    <span class="track-result-skeleton"></span>
                                    <span class="track-result-skeleton"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slide slide-6">
                        <div class="refund-modal-body-part refund-modal-final">
                            <div class="refund-modal-final-opt opt1 hidden">
                                <div class="cards">
                                    <div class="card">
                                        <img src="https://www.ican4consumers.com/public/images/phone-call.png" alt="">
                                        <p>Call us at<br>(855) 660-3214</p>
                                    </div>
                                    <div class="card">
                                        <p>Chat now</p>
                                        <img src="https://www.ican4consumers.com/public/images/chat.png" alt="">
                                        <button class="refund-modal-chat">START</button>
                                    </div>
                                    <div class="card">
                                        <p>Send an email</p>
                                        <img src="https://www.ican4consumers.com/public/images/message.png" alt="">
                                        <button class="refund-modal-email">START</button>
                                    </div>
                                </div>
                            </div>

                            <div class="refund-modal-final-opt opt2 hidden">
                                <p>For more information about your product</p>
                                <div class="cards">
                                    <div class="card">
                                        <img src="https://www.ican4consumers.com/public/images/phone-call.png" alt="">
                                        <p>You can call <span id="merchant">Merchant</span> at <br><span id="merchant_phone">Phone Number</span></p>
                                    </div>
                                    <div class="card">
                                        <img src="https://www.ican4consumers.com/public/images/message.png" alt="">
                                        <p>Or email them <br> at <br> <span id="merchant_email">Email</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="refund-modal-final-opt opt3 hidden">
                                <p>We're happy to help you, <br> please contact our customer support team
                                    available
                                    24/7</p>
                                <div class="cards">
                                    <div class="card">
                                        <img src="https://www.ican4consumers.com/public/images/phone-call.png" alt="">
                                        <p>Call us at<br>(855) 660-3214</p>
                                    </div>
                                    <div class="card">
                                        <p>Chat now</p>
                                        <img src="https://www.ican4consumers.com/public/images/chat.png" alt="">
                                        <button class="refund-modal-chat">START</button>
                                    </div>
                                    <div class="card">
                                        <p>Send an email</p>
                                        <img src="https://www.ican4consumers.com/public/images/message.png" alt="">
                                        <button class="refund-modal-email">START</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="refund-modal-footer">
            <button id="refund-modal-start" class="footer-buttons primary">Enter</button>

            <div id="question-buttons" class="footer-buttons hidden">
                <button class="refund-modal-back">Back</button>
                <button class="refund-modal-close">Close</button>
            </div>

            <div id="opt-buttons" class="footer-buttons hidden">
                <button class="refund-modal-back">Back</button>
                <div>
                    <button class="opt-button refund-modal-refund-last refund-modal-refund hidden">Refund my last
                        purchase</button>
                    <button class="opt-button refund-modal-get-refund refund-modal-refund hidden">Get a Refund</button>
                    <button class="opt-button refund-modal-cancel-member hidden">Cancel Membership</button>
                    <button class="opt-button refund-modal-track primary hidden">Track Order</button>
                    <button class="opt-button refund-modal-next primary">Next</button>
                </div>
            </div>
        </div>
    </div>

    <div class="refund-modal-multiple-txn">
        <div class="refund-modal-multiple-txn-inner">
            <div class="refund-modal-multiple-txn-header">
                <h4>Order Selection</h4>
            </div>

            <div class="refund-modal-multiple-txn-body">
                <div class="info">
                    <i class="fas fa-info-circle"></i>
                    <p>There are multiple orders found based on the details you provided. Please select the
                        desired
                        order.</p>
                </div>

                <div class="txn-cards">
                    <!-- cards -->
                </div>
            </div>

            <div class="refund-modal-multiple-txn-footer">
                <button class="order-selection-cancel">Cancel</button>
                <button class="order-selection-select primary">Select</button>
            </div>
        </div>
    </div>

    <div class="refund-modal-descriptor-search" id="refund-modal-descriptor-search">
        <div class="refund-modal-descriptor-search-inner">
            <div class="refund-modal-descriptor-search-header">
                <i class="fa fa-times" id="refund-modal-descriptor-close"></i>
            </div>

            <div class="refund-modal-descriptor-search-body">
                <h4>What website did you buy the product or service or what descriptor appears on your card
                    statement?</h4>

                <div class="descriptor-searchfield">
                    <input type="text" class="descriptor_key" placeholder="Website / Descriptor">
                    <ul class="results">
                        <li class="skeleton hidden"><i>Searching...</i></li>
                    </ul>
                </div>
            </div>

            <div class="refund-modal-descriptor-search-footer">
                <button id="search-descriptor-next" disabled="">Next</button>
            </div>
        </div>
    </div>

    <div class="refund-modal-redirection-alert refund-modal-alert">
        <div class="refund-modal-alert-inner">
            <div class="refund-modal-alert-head">
                <i class="fas fa-exclamation-circle"></i>
                <h4>Unable to track order.</h4>
            </div>
            <p>We are unable to track your order, but we can contact the merchant on your behalf if you would
                like
                to get a refund based on the information you've submitted. You will be redirected after a few
                moments.</p>
        </div>
    </div>

    <div class="refund-modal-confirm-cancellation refund-modal-alert">
        <div class="refund-modal-alert-inner">
            <div class="refund-modal-alert-head">
                <i class="fas fa-exclamation-circle"></i>
                <h4>Cancel Membership.</h4>
            </div>
            <p>Are you sure you want to cancel your membership?</p>
            <div class="refund-modal-alert-buttons">
                <button id="cancel-member-yes">Yes</button>
                <button id="cancel-member-no" class="primary">No</button>
            </div>
        </div>
    </div>

    <div class="refund-modal-request-error refund-modal-alert">
        <div class="refund-modal-alert-inner">
            <div class="refund-modal-alert-head">
                <i class="fas fa-exclamation-circle"></i>
                <h4>Error.</h4>
            </div>
            <p>An error occured. Please try again after some time.</p>
            <div class="refund-modal-alert-buttons">
                <button id="error-ok" class="primary">Okay, I understand</button>
            </div>
        </div>
    </div>



    <div class="refund-request-exist-alert refund-modal-alert">
        <div class="refund-modal-alert-inner">
            <div class="refund-modal-alert-head">
                <i class="fas fa-exclamation-circle"></i>
                <h4>Refund Failed.</h4>
            </div>
            <p>There is an existing refund request in our system with these details. Please contact your
                merchant
                for further assistance.</p>
            <div style="display:flex;justify-content:flex-end;">
                <button class="primary">Okay</button>
            </div>
        </div>
    </div>

    <div class="refund-request-modal" style="
        position: absolute;
        top: 0;
        backdrop-filter: blur(3px);
        left: 0;
        display: none;
        width: 100%;
        height: 100vh;
        background: rgb(0 0 0 / 20%);
        ">
        <div class="refund-request-modal-content" style="
            background: #fafafa;
            padding: 50px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            position: absolute;
            display: flex;
            flex-direction: column;
            width: 800px;
            align-items: center;
            box-shadow: 0 3px 16px rgb(0 0 0 / 16%);
            ">
            <h3 style="color: #00a307; margin-bottom: 20px;">REFUND REQUESTED</h3>
            <p style="
            text-align: center;
            line-height: 40px;
            margin-bottom: 20px;
            ">
                We've successfully processed your refund request!<br><br>Confirmation code: <span id="confirmation-code"></span><br><br>If you have any question or need assistance, please
                call
                us at +1 855-660-3214.<br><br>Thank you for using iCAN4Consumers, the only completely
                independent
                Credit Adjustment Network for Consumers</p>
            <button style="
            background: #072a48;
            color: white;
            min-width: 120px;
            margin-bottom: 20px;
            ">Close</button>

        </div>
    </div>
</div>
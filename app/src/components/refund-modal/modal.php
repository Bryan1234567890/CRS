<link rel="stylesheet" href="<?= CSS_PATH ?>modal.min.css">

<div class="refund-modal" id="refundModal">

    <div class="modal-inner">



        <div class="modal-head">
            <i class="fa fa-times modal-close"></i>
        </div>

        <div class="modal-body">

            <div class="viewport s1">


                <div class="slides">


                    <div class="slide slide-1">

                        <div class="modal-body-part modal-init">
                            <h3>How may I help you today?</h3>
                            <select name="help-select" id="help-select">
                                <option value="1">I have a question about my purchase.</option>
                                <option value="2">I don't know how to use the product I purchased.</option>
                                <option value="3">I didn't receive what I ordered.</option>
                                <option value="4">I don't recognize this purchase.</option>
                                <option value="5">I want to cancel my membership.</option>
                            </select>
                        </div>

                    </div>


                    <div class="slide slide-2">

                        <div class="modal-body-part modal-track-order hidden">
                            <div class="descriptor-searchfield">
                                <p>What website did you buy the product or service or what descriptor appears on your card statement?</p>
                                <input type="text" class="descriptor_key" placeholder="Website / Descriptor ">
                                <ul class="results">
                                    <!--  -->
                                    <li class="skeleton hidden"><span></span></li>
                                    <li class="skeleton hidden"><span></span></li>
                                    <li class="skeleton hidden"><span></span></li>
                                </ul>
                            </div>
                            <div class="modal-txn-user-details">
                                <input class='txn-detail' type="text" name="order_no" id="order_no" placeholder='Order No.' disabled>
                                <p class='divider'>Or</p>
                                <p class=subtitle>*All fields below are required.</p>
                                <div class="dual-input">
                                    <input class='txn-detail' type="number" name="first6" id="first6" placeholder="First 6 Card Digit" max="999999" disabled>
                                    <input class='txn-detail' type="number" name="last4" id="last4" placeholder="Last 4 Card Digit" max="9999" disabled>
                                </div>
                                <div class="dual-input">
                                    <input class='txn-detail' type="text" name="firstname" id="firstname" placeholder="Firstname" disabled autocomplete="off">
                                    <input class='txn-detail' type="text" name="lastname" id="lastname" placeholder="Lastname" disabled autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body-part modal-track-membership hidden">
                            <div class="descriptor-searchfield">
                                <p>What website did you buy the product or service or what descriptor appears on your card statement?</p>
                                <input type="text" class="descriptor_key" placeholder="Website / Descriptor ">
                                <ul class="results">
                                    <!--  -->
                                    <li class="skeleton hidden"><span></span></li>
                                    <li class="skeleton hidden"><span></span></li>
                                    <li class="skeleton hidden"><span></span></li>
                                </ul>
                            </div>
                            <div class="modal-txn-user-details">
                                <p class=subtitle>*All fields below are required.</p>
                                <div class="dual-input">
                                    <input class='txn-detail' type="number" name="first6" id="member_order_no" placeholder="Order Number" disabled>
                                    <input class='txn-detail' type="email" name="last4" id="member_email_address" placeholder="Email address" disabled>
                                </div>
                                <div class="dual-input">
                                    <input class='txn-detail' type="number" name="first6" id="member_first6" placeholder="First 6 Card Digit" max="999999" disabled>
                                    <input class='txn-detail' type="number" name="last4" id="member_last4" placeholder="Last 4 Card Digit" max="9999" disabled>
                                </div>
                                <div class="dual-input">
                                    <input class='txn-detail' type="text" name="firstname" id="member_firstname" placeholder="Firstname" disabled autocomplete="off">
                                    <input class='txn-detail' type="text" name="lastname" id="member_lastname" placeholder="Lastname" disabled autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="slide slide-3">

                        <div class="modal-body-part modal-track-order part2 hidden">
                            <div class="modal-txn-user-details">
                                <p>Date of Purchase</p>
                                <input class='txn-detail' type="date" name="time" id="time" placeholder="Date of purchase" disabled>
                                <div class="dual-input">
                                    <input class='txn-detail' type="text" name="email_address" id="email_address" placeholder="Email address" disabled autocomplete="off">
                                    <input class='txn-detail' type="number" name="amount" id="amount" placeholder="Amount of purchase (USD)" disabled autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="slide slide-4">

                        <div class="modal-body-part modal-track-result hidden">

                            <div class="modal-track-result-head modal-shipping">
                                <span class="track-result-skeleton"></span>
                                <span class="track-result-skeleton"></span>
                                <h3 class='hidden'>Your order was <span class="ship_stat">STATUS</span> on <span class="ship_date">DATE</span> via <span class="courier">COURIER</span>.</h3>
                                <p class='hidden'>Tracking Number: <span class="tracking_no">TRACKING NO</span></p>
                            </div>

                            <div class="modal-track-result-head modal-txn-info hidden">
                                <h2>Your Transaction Info:</h2>
                            </div>


                            <div class="modal-track-result-item">
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


                            <div class="modal-track-result-item">
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


                            <div class="modal-track-result-item">
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


                            <div class="modal-track-result-item shipping">
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

                        <div class="modal-body-part modal-not-found hidden">
                            <img src="<?= IMG_PATH ?>no-data.jpg" alt="">
                            <h4>The transaction/subscription based on the information you provided was not found.</h4>
                        </div>

                    </div>


                    <div class="slide slide-5">


                        <div class="modal-body-part modal-cancellation-request hidden">

                            <div class="inner hidden">
                                <h3>Thank you!</h3>

                                <p class="cancellation-request-result">

                                </p>

                                <p>Questions? Call us Toll Free <span>(855) 660-3214</span> or email <span>support@iCan4Consumers.com</span></p>
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

                        <div class="modal-body-part modal-final">

                            <div class="modal-final-opt opt1 hidden">

                                <div class="cards">

                                    <div class="card">
                                        <img src="<?= IMG_PATH ?>phone-call.png" alt="">
                                        <p>Call us at<br>(855) 660-3214</p>
                                    </div>

                                    <div class="card">
                                        <p>Chat now</p>
                                        <img src="<?= IMG_PATH ?>chat.png" alt="">
                                        <button class="modal-chat">START</button>
                                    </div>

                                    <div class="card">
                                        <p>Send an email</p>
                                        <img src="<?= IMG_PATH ?>message.png" alt="">
                                        <button class="modal-email">START</button>
                                    </div>

                                </div>

                            </div>

                            <div class="modal-final-opt opt2 hidden">

                                <p>For more information about your product</p>

                                <div class="cards">

                                    <div class="card">
                                        <img src="<?= IMG_PATH ?>phone-call.png" alt="">
                                        <p>You can call <span id='merchant'>Merchant</span> at <br><span id='merchant_phone'>Phone Number</span></p>
                                    </div>

                                    <div class="card">
                                        <img src="<?= IMG_PATH ?>message.png" alt="">
                                        <p>Or email them <br> at <br> <span id='merchant_email'>Email</span></p>
                                    </div>

                                </div>

                            </div>

                            <div class="modal-final-opt opt3 hidden">

                                <p>We're happy to help you, <br> please contact our customer support team available 24/7</p>

                                <div class="cards">

                                    <div class="card">
                                        <img src="<?= IMG_PATH ?>phone-call.png" alt="">
                                        <p>Call us at<br>(855) 660-3214</p>
                                    </div>

                                    <div class="card">
                                        <p>Chat now</p>
                                        <img src="<?= IMG_PATH ?>chat.png" alt="">
                                        <button class="modal-chat">START</button>
                                    </div>

                                    <div class="card">
                                        <p>Send an email</p>
                                        <img src="<?= IMG_PATH ?>message.png" alt="">
                                        <button class="modal-email">START</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="modal-footer">
            <button id='modal-start' class='footer-buttons primary'>Enter</button>

            <div id="question-buttons" class='footer-buttons hidden'>
                <button class='modal-back'>Back</button>
                <button class='modal-close'>Close</button>
            </div>

            <div id="opt-buttons" class='footer-buttons hidden'>
                <button class="modal-back">Back</button>
                <div>
                    <button class="opt-button modal-refund-last modal-refund hidden">Refund my last purchase</button>
                    <button class="opt-button modal-get-refund modal-refund hidden">Get a Refund</button>
                    <button class="opt-button modal-cancel-member hidden">Cancel Membership</button>
                    <button class="opt-button modal-track primary hidden">Track Order</button>
                    <button class="opt-button modal-next primary">Next</button>
                </div>
            </div>
        </div>



    </div>



    <div class="modal-descriptor-search" id="modal-descriptor-search">


        <div class="modal-descriptor-search-inner">

            <div class="modal-descriptor-search-header">
                <i class="fa fa-times" id='modal-descriptor-close'></i>
            </div>

            <div class="modal-descriptor-search-body">
                <h4>What website did you buy the product or service or what descriptor appears on your card statement?</h4>

                <div class="descriptor-searchfield">
                    <input type="text" class="descriptor_key">
                    <ul class="results">
                        <!--  -->
                        <li class="skeleton hidden"><span></span></li>
                        <li class="skeleton hidden"><span></span></li>
                        <li class="skeleton hidden"><span></span></li>
                    </ul>
                </div>
            </div>

            <div class="modal-descriptor-search-footer">
                <button id="search-descriptor-next" disabled>Next</button>
            </div>


        </div>


    </div>


    <div class="modal-redirection-alert">
        <div class="modal-redirection-alert-inner">
            <div class="modal-redirection-alert-head">
                <i class="fas fa-exclamation-circle"></i>
                <h4>Unable to track order.</h4>
            </div>
            <p>We are unable to track your order, but we can contact the merchant on your behalf if you would like to get a refund based on the information you've submitted. You will be redirected after a few moments.</p>
        </div>
    </div>


</div>

<script src="<?= JS_PATH ?>modal.js"></script>
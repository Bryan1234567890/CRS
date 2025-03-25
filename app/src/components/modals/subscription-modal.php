<div class="subscription-modal" id="subscription-modal">
    <div class="subscription-modal-inner">
        <div class="subscription-modal-head">
            <i class="fa fa-times subscription-modal-close"></i>
        </div>

        <div class="subscription-modal-body">
            <div class="viewport s0">
                <div class="slides">

                    <!-- Slide 0: Collect missing data -->
                    <div class="slide slide-0">
                        <div class="subscription-modal-body-part subscription-modal-track-order" style="padding: 20px;">
                            <h4>For verification, please provide the following information:</h4>
                            <div class="dual-input">
                                <label>Email</label>
                                <input type="email" id="input-email" class="input-field" placeholder="Enter your email" />
                            </div>
                            <div class="dual-input">
                                <label>First 4 digits of card</label>
                                <input type="text" id="input-first6" class="input-field" maxlength="6" placeholder="1234" />
                            </div>
                            <div class="dual-input">
                                <label>Last 4 digits of card</label>
                                <input type="text" id="input-last4" class="input-field" maxlength="4" placeholder="5678" />
                            </div>
                            <div style="text-align: right; margin-top: 20px;">
                                <button class="opt-button" id="submit-subscription-info" style="background-color:#2d98da; color: #fff;">Continue</button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 1: Subscription details -->
                    <div class="slide slide-1">
                        <div class="subscription-modal-body-part subscription-modal-track-order" id="subscription-details"></div>
                    </div>

                    <!-- Slide 2: Cancellation Confirmation -->
                    <div class="slide slide-2">
                        <div class="modal-body-part modal-cancellation-request">
                            <div class="loading-container">
                            <div class="loading-ring"></div>
                            </div>
                            <div id="slide2" class="inner hidden">
                            <div class="hidden slide2Text">
                                    <h3 style="text-align: center;">Thank you, your subscription has been cancelled!</h3>
                                    <div class="flex-div">
                                        transaction code:
                                        <span id="slide2TRN"></span>
                                        <button class="icon-button copyButton" onclick="copyToClipboard('slide2TRN')">
                                            <img src="<?= IMG_PATH; ?>/fav/copy-icon.png" alt="">
                                        </button>
                                    </div>
                                    <p style="text-align: center; margin-bottom: 30px;">Thank you for using iCAN 4 Consumers!</p>
                                    <p style="text-align: center;">Would you like to request a refund for this transaction?</p>
                                    <div style="display: flex; justify-content: center; margin-top: 10px">
                                        <button class="opt-button footer-buttons subscription-modal-close" style="margin-right: 20px">No</button>
                                        <button id="subscription-refund-request-modal" disabled>Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Refund Request Confirmation -->
                    <div class="slide slide-3">
                        <div class="modal-body-part modal-cancellation-request">
                            <div class="inner">
                                <div class="loading-container"><div class="loading-ring"></div></div>
                                <div class="slide3Text hidden">
                                    <div class="modal-content flex-column" style="align-items: center;">
                                        <h2 style="text-align: center; font-weight: bold; color: #5bd25b;">REFUND REQUESTED</h2>
                                        <div class="flex-div">
                                            Reference Number:
                                            <span id="slide3TRN"></span>
                                            <button class="icon-button copyButton" onclick="copyToClipboard('slide3TRN')">
                                                <img src="<?= IMG_PATH; ?>/fav/copy-icon.png" alt="">
                                            </button>
                                        </div>
                                        <i class="fa fa-check-circle-o" style="color: #5bd25b; font-size: 50px;"></i>
                                        <p>We've successfully contacted the merchant on your behalf!</p>
                                        <p>If you need help, call us at +1 855-660-3214.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="subscription-modal-footer">
            <button class="footer-buttons primary subscription-modal-close">Close</button>
        </div>
    </div>
</div>

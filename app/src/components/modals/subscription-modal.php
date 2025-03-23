<?php $subscriptions = isset($data['subscriptions']) ? $data['subscriptions'] : []; ?>

<div class="subscription-modal" id="subscription-modal">
    <div class="subscription-modal-inner">
        <div class="subscription-modal-head">
            <i class="fa fa-times subscription-modal-close"></i>
        </div>

        <div class="subscription-modal-body">
            <div class="viewport s1">
                <div class="slides">

                    <!-- Slide 1: Subscription Details -->
                    <div class="slide slide-1">
                        <div class="subscription-modal-body-part subscription-modal-track-order">
                            
                            <?php if (isset($subscriptions['Status']) && $subscriptions['Status'] === 'Error') : ?>
                                <div class="subscription-modal-txn-user-details">
                                    <div>The record cannot be found.</div>
                                </div>
                            <?php else : ?>
                              <h4>Merchant: <?php echo strtoupper($data['merchant']['website_address']?? 'No Merchant Data Found.'); ?></h4>
                              <p>Subscription details:</p>

                              <?php 
                              $activeSubscriptionsCount = 0; 

                              foreach ($subscriptions as $key => $sub) :
                                  $subscription = $sub['subscription'];
                                  $name = $subscription['name'];
                                  $cardNumber = $subscription['profile']['paymentProfile']['payment']['creditCard']['cardNumber'];
                                  $amount = $subscription['amount'];
                                  $interval_unit = $subscription['paymentSchedule']['interval']['unit'];
                                  $interval_length = $subscription['paymentSchedule']['interval']['length'];
                                  $interval = '';

                                  switch ($interval_unit) {
                                      case 'months':
                                          $interval = ($interval_length == 1) ? 'Monthly' : "Every $interval_length Months";
                                          break;
                                      default:
                                          break;
                                  }

                                  if ($subscription['status'] === 'active') :
                                      $activeSubscriptionsCount++;
                              ?>
                                      <div class="subscription-modal-txn-user-details">
                                          <div class="dual-input">
                                              <div>
                                                  <span class="placeholder"><?= $name ?> <?= $cardNumber ?></span>
                                                  <p><?= $interval ?></p>
                                              </div>
                                              <p>$ <?= $amount ?></p>
                                          </div>
                                          <div class="dual-input">
                                              <p></p>
                                              <button id="subscription-modal-start" class="opt-button modal-track footer-buttons glowblue"
                                                  style="background-color:#fa8231; color: #f8f8f8;" 
                                                  data-subscriptionId="<?= $key ?>">
                                                  Cancel Subscription
                                              </button>
                                          </div>
                                      </div>
                              <?php 
                                  endif;
                              endforeach; 

                              if ($activeSubscriptionsCount === 0) : 
                              ?>
                                  <strong>No active subscriptions found.</strong>
                              <?php 
                              endif; 
                              ?>

                            <?php endif; ?>

                        </div>
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
                                        Confirmation code:
                                        <span id="slide2TRN"></span>
                                        <button class="icon-button copyButton" onclick="copyToClipboard('slide2TRN')">
                                            <img src="<?= IMG_PATH; ?>/fav/copy-icon.png" alt="">
                                        </button>
                                    </div>
                                    <p style="text-align: center; margin-bottom: 30px; padding-left: 30px; padding-right: 30px;">
                                        Thank you for using iCAN 4 Consumers, the only completely independent Credit Adjustment Network for Consumers!
                                    </p>
                                    <p style="text-align: center; padding-bottom: 20px; padding-left: 30px; padding-right: 30px;">
                                        Would you like to request a refund for this transaction?
                                    </p>
                                    <div style="display: flex; justify-content: center; margin: auto; text-align: center; margin-bottom: 30px;">
                                        <button class="opt-button modal-track footer-buttons subscription-modal-close" style="margin-right: 20px;">
                                            No
                                        </button>
                                        <button id="subscription-refund-request-modal">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: Refund Request Confirmation -->
                    <div class="slide slide-3">
                        <div class="modal-body-part modal-cancellation-request">
                            <div class="inner">
                                <div class="loading-container">
                                    <div class="loading-ring"></div>
                                </div>
                                <div class="slide3Text hidden">
                                    <div class="modal-content flex-column" style="align-items: center; width: 700px; height: 360px; margin-left: 40px; margin-right: 30px;">
                                        <h2 style="text-align: center; font-weight: bold; color: #5bd25b; margin-bottom: 30px; margin-top: 6px;">
                                            REFUND REQUESTED
                                        </h2>
                                        <div class="flex-div">
                                            Reference Number:
                                            <span id="slide3TRN"></span>
                                            <button class="icon-button copyButton" onclick="copyToClipboard('slide3TRN')">
                                                <img src="<?= IMG_PATH; ?>/fav/copy-icon.png" alt="">
                                            </button>
                                        </div>
                                        <i class="fa fa-check-circle-o" aria-hidden="true" style="color: #5bd25b; font-size: 50px; margin-bottom: 20px;"></i>
                                        <p style="margin-bottom: 20px;">We've successfully contacted the merchant on your behalf!</p>
                                        <p style="margin-bottom: 20px;">If you have any questions or need assistance, please call us at +1 855-660-3214.</p>
                                        <p style="text-align: center; margin-bottom: 30px;">
                                            Thank you for using iCAN 4 Consumers, the only completely independent Credit Adjustment Network for Consumers!
                                        </p>
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

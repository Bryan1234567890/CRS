<div class="footer">
    <div class="container">
        <div class="row">
            <div class="v-stack col-lg-4">
                <a href="<?= BASE_PATH ?>">
                    <img alt="logo" src="<?= IMG_PATH ?>ican_logo_cropted.png" class="mjp-image" width="140" />
                </a>
                <br>
                <small>
                    &copy; <?php echo date("Y"); ?> iCAN4Consumers. All rights Reserved
                </small>

                <div class="h-stack gap-20 mt-20">
                    <div class="self-centered p-5">
                        <i class="fa-brands fa-facebook fa-lg"></i>
                    </div>
                    <img alt="trust-mark_pcidss" src="<?= IMG_PATH ?>ican-trust-mark_pcidss.png" class="" width="200px">
                </div>
            </div>
            <div class="col-sm-8">
                <div class="v-stack col-lg-4">
                    <p class="f-title css-dculj6">Company</p>
                    <a class="f-link " href="/about">About us</a>
                    <a class="f-link " href="/support">Support</a>
                    <a class="f-link " href="/news">News</a>
                    <a class="f-link " href="/security">Security</a>
                    <a class="f-link " href="/contact">Contact us</a>
                </div>
                <div class="v-stack col-lg-4">
                    <p class="f-title">Support</p>
                    <a class="f-link" data-open-modal="terms-and-conditions">Terms and Conditions</a>
                    <a class="f-link" data-open-modal="privacy-policy">Privacy Policy</a>
                </div>
                <div class="v-stack col-lg-4 ">
                    <p class="f-title css-dculj6">Install App</p>
                    <div class="h-stack gap-5 css-cfwrg8">
                        <a target="_blank" class="" href="https://play.google.com/store/apps/details?id=app.ipp.ic4c&amp;hl=en">
                            <img alt="" src="<?= IMG_PATH ?>ap-128x40.png" class="">
                        </a>
                        <a target="_blank" class="" href="https://itunes.apple.com/us/app/ican4consumers/id1061524349?ls=1&amp;mt=8">
                            <img alt="" src="<?= IMG_PATH ?>gp-128x40.png" class="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    // include './app/src/components/modals/get-your-refund.php';
    include './app/src/components/modals/how-it-works.php';
    include './app/src/components/modals/privacy-policy.php';
    include './app/src/components/modals/terms-and-conditions.php';
    include './app/src/components/modals/refund-modal-2.php';
?>
<?php
    include './app/src/components/chat.php'
?>
<!-- <link rel="stylesheet" href="./app/chat/cdn/chatlibrary.css">
<script src="./app/chat/cdn/chatlibrary.js"></script>
<div class="chat-container chat-box css-egn4ro" themes="default"></div> -->

<script src="<?= JS_PATH ?>accordion.js"></script>
<script src="<?= JS_PATH ?>modal.js"></script>
<script src="<?= JS_PATH ?>refund-modal-2.js"></script>
<script src="<?= JS_PATH ?>subscription-modal.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    AOS.init();
</script>
</body>

</html>
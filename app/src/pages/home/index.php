<?php require_once 'app/src/components/modals/subscription-modal.php' ?>

<div class="container">
    <div class="section">
        <div class="wrapped-hero">
            <div class="row">
                <div class="col-lg-6 flex-center direction-row">
                    <div class="">
                        <h2 class="hero-heading c-text">We Can Help you,
                            <span class="c-green">get your refund!</span>
                        </h2>
                        <p class="text">
                            If you have a question about the product or service you purchased or if you did not receive your purchase or maybe you don't recognize a charge on your card statement.
                        </p>
                        <br>
                        <div class="btn-group hero-btn-group mt-20">
                            <button class="btn btn-primary mr-10 refund-btn-i refund-modal-btn" id="refundModalBtn"><img src="<?= IMG_PATH ?>iCAN_Chevron_white.png" alt="" class="ican-chevron" id="refundModalBtn"> Click Here</button>
                            <button class="btn play-modal-vid"><i class="fa fa-play mr-8"></i> How it Works</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-img">
                        <img src="<?= IMG_PATH ?>businessman.png" alt="hero img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class=mouse-container>
            <div class=mouse-wheel></div>
        </div>
        <h4 class="mouse-text">Scroll Down</h4>
    </div>
    <div class="section section-area">
        <div class="wrapped-about">

            <div class="flex gap-20 flex-x-y">
                <div class="about-flex-img">
                    <img src="<?= IMG_PATH ?>ican_info_1.png" alt="ican info 1">
                </div>
                <div class="self-centered">
                    <div class="">
                        <h1 class="h-text">Say goodbye to red tape</h1>
                        <p class="text">For consumers who are dissatisfied with the service or product delivered, we provide them with a means for getting their money back quickly and easily, and at no cost to them!</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-20 flex-x-y direction-reverse ">
                <div class="about-flex-img">
                    <img src="<?= IMG_PATH ?>ican_info_2.png" alt="ican info 1">
                </div>
                <div class="self-centered">
                    <div class="">
                        <h1 class="h-text">Say goodbye to red tape</h1>
                        <p class="text">For consumers who are dissatisfied with the service or product delivered, we provide them with a means for getting their money back quickly and easily, and at no cost to them!</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section section-area">
    <div class="wrapped-faq">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="flex direction-col">
                        <h1>FAQ</h1>
                    </div>
                    <br><br><br><br>
                    <br><br><br><br>

                    <div class="flex-center flex">
                        <img src="../../../../public/img/megap.png" alt="faq megap" class="megap-img" width="50px">
                    </div>
                </div>
                <div class="col-lg-6 faq-scroll-box">
                    <div class="accordion faq-list">
                        <?php
                        include './app/src/components/faq-list.php'
                        ?>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>


<div class="section ">
    <div class="wrapped-testimonials">
        <div class="container">
            <div class="row flex-center">
                <div class="col-lg-6">
                    <div class="heading">
                        <h1 class="h-text" align="center">Our Clients Speak</h1>
                    </div>
                    <p class="text" align="center">We have been working with clients around the world</p>
                </div>
            </div>
            <div class="row margin-area-top">
                <div class="col-lg-4">
                    <div class="testimonials-box">
                        <div class="card">
                            <div class="card-heading " align="center">
                                "No jumping through hoops"
                            </div>
                            <p class="text" align="center">In the past I've always had a hard time with all the things required to ask for a refund. Thanks to you, i don't have to anymore.</p>
                        </div>

                        <div class="testimonials-author mt-20">
                            <div class="flex-center">
                                <span alt="Alex Cooper" class="avatar">
                                    <img src="https://img.freepik.com/free-photo/woman-portrait-with-blue-lights-visual-effects_23-2149419461.jpg?t=st=1658375033~exp=1658375633~hmac=0cf5fc4b4ebec77ae74f501a54e5aa492d5b154909da6dcef78d3457e6b9bf00&w=996" alt="avatar-md" class="avatar-img">
                                </span>
                            </div>
                            <div align="center">
                                <div class="h-text">
                                    Alex Cooper
                                </div>
                                <div class="text">
                                    <small>
                                        Financial Analyst
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="testimonials-box">
                        <div class="card">
                            <div class="card-heading " align="center">
                                "SO FAST"
                            </div>
                            <p class="text" align="center">I requested my refund monday and got a notif that it got done tuesday</p>
                        </div>
                        <div class="testimonials-author mt-20">
                            <div class="flex-center">
                                <span alt="Alex Cooper" class="avatar">
                                    <img src="https://img.freepik.com/free-photo/questioned-guy-take-off-earbud-hear_176420-20011.jpg?t=st=1658371294~exp=1658371894~hmac=21dbdc95d383dc0ad703a307c86b27f613e9bd22b468711a3c98c08e37ac8e2f&w=996" alt="avatar-md" class="avatar-img">
                                </span>
                            </div>
                            <div align="center">
                                <div class="h-text">
                                    Ryan Spark
                                </div>
                                <div class="text">
                                    <small>
                                        Chief Marketing Officer
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="testimonials-box">
                        <div class="card">
                            <div class="card-heading " align="center">
                                "Confidentiality is respected"
                            </div>
                            <p class="text" align="center">I have never been more thankful for a service. Respect of privacy is very important to me and i feel like going to the bank having to explain these things makes me uncomfortable. Thank you. These guys are legit!</p>
                        </div>
                        <div class="testimonials-author mt-20">
                            <div class="flex-center">
                                <span alt="Alex Cooper" class="avatar">
                                    <img src="https://img.freepik.com/free-photo/young-handsome-man-listens-music-with-earphones_176420-15616.jpg?t=st=1658375033~exp=1658375633~hmac=f7f7c8d5a3d8aa83101fb6dc8b66b595250cc8486a6227ec94e4e789d8eb97c7&w=996" alt="avatar-md" class="avatar-img">
                                </span>
                            </div>
                            <div align="center">
                                <div class="h-text">
                                    Peter John
                                </div>
                                <div class="text">
                                    <small>
                                        Chief Executive Officer
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
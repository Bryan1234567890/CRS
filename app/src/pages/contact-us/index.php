<div class="section padding-area-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="v-stack">
                    <div class="div">
                        <div class="wrap">
                            <h1 class="h-text">
                                Send us a message
                            </h1>
                            <span class="text">Fill up the form below to contact.</span>
                        </div>
                        <br>
                        <form action="/sendMessage.php" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="input-field required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="email">Email address</label>
                                        <input type="text" name="email" id="email" class="input-field required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="message">Message</label>
                                        <input type="text" name="message" id="message" class="input-field required">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mt-15">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="contact-us-image">
                    <img src="<?=IMG_PATH?>contact.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
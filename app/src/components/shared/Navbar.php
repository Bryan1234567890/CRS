<div class="navbar ">
    <div class="container">
        <div class="h-stack ">
            <div class="wrapped flex-between">
                <div class="nav-bars flex-center direction-col">
                    <button type="button" class="btn burger" aria-label="Toggle Navigation" onclick="openNav()">
                        <i class="fa fa-bars m-0 p-0"></i>
                    </button>
                </div>

                <div class="h-stack">
                    <a href="<?= BASE_PATH ?>" class="logo">
                        <img alt="logo" src="<?= IMG_PATH ?>ican_logo_cropted.png" class="css-image " width="130" />
                    </a>
                    <div class="wrapped self-centered wrapped-menu ">
                        <div class="h-stack menu-group x-mobile">
                            <div class="menu-list <?= ($this->activemenu == 'home' ? 'current' : '') ?>"><a href="<?= BASE_PATH ?>" class="menu-link" aria-haspopup="dialog" aria-expanded="false" aria-controls="popover-content">Home</a></div>
                            <div class="menu-list <?= ($this->activemenu == 'about' ? 'current' : '') ?>"><a href=" <?= BASE_PATH ?>about" class="menu-link" aria-haspopup="dialog" aria-expanded="false" aria-controls="popover-content">About</a></div>
                            <div class="menu-list <?= ($this->activemenu == 'support' ? 'current' : '') ?>"><a href="<?= BASE_PATH ?>support" class="menu-link" aria-haspopup="dialog" aria-expanded="false" aria-controls="popover-content">Support</a></div>
                            <div class="menu-list <?= ($this->activemenu == 'news' ? 'current' : '') ?>"><a href="<?= BASE_PATH ?>news" class="menu-link" aria-haspopup="dialog" aria-expanded="false" aria-controls="popover-content">News</a></div>
                            <div class="menu-list <?= ($this->activemenu == 'security' ? 'current' : '') ?>"><a href="<?= BASE_PATH ?>security" class="menu-link" aria-haspopup="dialog" aria-expanded="false" aria-controls="popover-content">Security</a></div>
                        </div>
                    </div>
                </div>

                <div class="h-stack self-centered nc-right ">
                    <a href="tel:855-660-3214" class="a-link css-button self-centered text ">Toll-Free (855) 660-3214</a>
                    <button type="button" class="btn btn-primary refund-modal-btn">Get your refund</button>
                    <span class="self-centered refund-modal-btn text">Refund</span>
                </div>
            </div>


            <div class="collapse mb-menu">
                <div class="v-stack pr-20 pl-20">
                    <div class="css-stack pt-20 pb-20">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; <span>Close</span></a>
                    </div>

                    <div class="css-stack  <?= ($this->activemenu == 'home' ? 'current' : '') ?>">
                        <a href="<?= BASE_PATH ?>" class="css-link">
                            <p class="css-text">Home</p>
                        </a>
                    </div>
                    <div class="css-stack <?= ($this->activemenu == 'about' ? 'current' : '') ?>">
                        <a href="<?= BASE_PATH ?>about" class="css-link">
                            <p class="css-text">About</p>
                        </a>
                    </div>
                    <div class="css-stack <?= ($this->activemenu == 'support' ? 'current' : '') ?>">
                        <a href="<?= BASE_PATH ?>support" class="css-link">
                            <p class="css-text">Support</p>
                        </a>
                    </div>
                    <div class="css-stack <?= ($this->activemenu == 'news' ? 'current' : '') ?>">
                        <a href="<?= BASE_PATH ?>news" class="css-link">
                            <p class="css-text">News</p>
                        </a>
                    </div>
                    <div class="css-stack <?= ($this->activemenu == 'security' ? 'current' : '') ?>">
                        <a href="<?= BASE_PATH ?>security" class="css-link">
                            <p class="css-text">Security</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const nav = $('.navbar');
    const burger = $('.burger');
    const mySidenav = $('.mb-menu');

    /* Set the width of the side navigation to 250px */
    function openNav() {

        mySidenav.css("width", "250px");
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        mySidenav.css("width", "0");
    }
</script>
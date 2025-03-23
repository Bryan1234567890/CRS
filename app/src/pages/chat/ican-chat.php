<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
     .iframe-chat-box {
        z-index: 8888888888888888888888888888;
  /*      display: -webkit-box;
        display: -ms-flexbox;*/
        display: flex;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .iframe-chat-box .open-chat-box {
        z-index: 88888888888888;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        cursor: pointer;
        position: fixed;
        width: 180px;
        height: 65px;
        bottom: 0;
        right: 110px;
        background-color: #2B74AE;
        -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border-radius: 4px 4px 0px 0px;
    }

    .iframe-chat-box .open-chat-box:hover {
        -webkit-box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    .iframe-chat-box .open-chat-box .chat-logo {
        margin-top: 10px;
        margin-left: 10px;
        position: relative;
        color: #fff;
    }

    .iframe-chat-box .open-chat-box .chat-logo .fa-comment {
        color: #fff;
        position: relative;
    }

    .iframe-chat-box .open-chat-box .chat-logo .dot-dot {
        color: #fff;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
        left: 11px;
        top: 0;
    }

    .iframe-chat-box .open-chat-box .ic4c-title {
        width: 100%;
        margin-top: 20px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .iframe-chat-box .open-chat-box .ic4c-title span {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        color: #fff;
        font-weight: 500;
        font-size: 20px;
    }

    @media screen and (max-width: 500px) {
        .iframe-chat-box .open-chat-box {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            right: 15px;
            bottom: 15px;
        }
        .iframe-chat-box .open-chat-box .chat-logo {
            display: block;
            margin-top: 20px;
            margin-left: 19px;
            position: relative;
            color: #fff;
        }
        
        .iframe-chat-box .open-chat-box .chat-logo .fa-comment {
            font-size: 40px;
            width: 100px;
            color: #fff;
            position: relative;
        }

        .iframe-chat-box .open-chat-box .chat-logo .dot-dot {
            color: #fff;
            position: absolute;
            font-weight: bold;
            font-size: 25px;
            left: 11px;
            top: -7px;
        }
        .iframe-chat-box .open-chat-box .ican-title {
            display: none;
        }
    }

    .iframe-chat-box .iframe-container {
        z-index: 888888888888888888888888888888888888888888888888888;
        position: fixed;
        width: 400px;
        bottom: 2px;
        right: 25px;
        background-color: #fff;
        -webkit-box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-transition: 350ms ease-out;
        -o-transition: 350ms ease-out;
        transition: 350ms ease-out;
    }

    @media screen and (max-width: 500px) {
        .iframe-chat-box .iframe-container {
            width: 100%;
            height: 100%;
            right: 0;
        }
    }

    .iframe-chat-box .iframe-container .minimize {
        padding: 15px;
        color: #fff;
        position: absolute;
        z-index: 10;
        cursor: pointer;
    }

    .iframe-chat-box .iframe-container iframe {
        padding: none;
        width: 100%;
        height: 550px;
    }

    @media screen and (max-width: 500px) {
        .iframe-chat-box .iframe-container iframe {
            height: 100vh;
        }
    }

    @-webkit-keyframes slide-down {
        0% {
            opacity: 1;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
        99% {
            opacity: 1;
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
        }
        100% {
            opacity: 0;
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
        }
    }

    @keyframes slide-down {
        0% {
            opacity: 1;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
        99% {
            opacity: 1;
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
        }
        100% {
            opacity: 0;
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
        }
    }

    @-webkit-keyframes slide-up {
        0% {
            opacity: 0;
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
    }

    @keyframes slide-up {
        0% {
            opacity: 0;
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
        }
        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
    }

    .hide-this {
        -webkit-animation: slide-down forwards 350ms ease-out;
        animation: slide-down forwards 350ms ease-out;
    }

    .show-this {
        -webkit-animation: slide-up forwards 350ms ease-out;
        animation: slide-up forwards 350ms ease-out;
    }

    .fixed {
        position: fixed;
    }
</style>

<!-- <div class="chat-circle open-chat-box" id="open_chat">

    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
    </svg>

</div> -->

<div class="iframe-chat-box">
        <div class="open-chat-box">
            <div class="chat-logo">
                <i class="far fa-comment fa-3x"></i>
                
            </div>    
            <div class="ic4c-title">
                <span>CHAT NOW</span>
            </div>
        </div>
        <div class="iframe-container hide-this">
            <i class="fas fa-window-minimize fa-lg minimize"></i>
            <iframe src="https://refund4u.net:8000/icanclient" frameborder="0"></iframe>
    </div>
</div>


<div class="iframe-chat-box"></div>




<script>
    $(function() {
        $('.iframe-chat-box').html(`
        <div class="open-chat-box">
            <div class="chat-logo">
                <i class="far fa-comment fa-3x"></i>
                
            </div>    
            <div class='ic4c-title'>
                <span>CHAT NOW</span>
            </div>
        </div>
        <div class="iframe-container hide-this">
             <i class="fas fa-window-minimize fa-lg minimize"></i>
        
            <iframe src="https://refund4u.net:8000/icanclient" frameborder="0"></iframe>
    </div>`);

        $('.open-chat-box').on('click', function() {
            $('.iframe-container').removeClass("show-this").removeClass("hide-this");
        });
        $('.minimize').on('click', function() {
            $('.iframe-container').removeClass("show-this").addClass("hide-this");
        });

        $('.close').on('click', function() {
            $('.iframe-container').removeClass("show-this").addClass("hide-this");
        });
    });
</script>

</script>

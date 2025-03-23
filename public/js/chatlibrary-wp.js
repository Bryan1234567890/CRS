jQuery(document).ready(function ($) {
    chat_body();
    chat_button();
    iframe();
    load_chatbox();

    // $('iframe').contents().find('body').html('<div> blah </div>');
    $('#open_chat').click(function () {
        // $('.chat-box').show(200)
        // $('.chat-box').addClass('open')
        if ($('.chat-box').hasClass('open')) {
            $('.chat-box').fadeOut()
            $('.chat-box').removeClass('open')
            $('.chat-box').removeClass('bodyclick')
        } else {
            $('.chat-box').fadeIn()
            $('.chat-box').addClass('open')
            setTimeout(function () {
                $('.chat-box').addClass('bodyclick')
            }, 1000)
        }
    })

    $('body').click(function () {
        if ($('.chat-box').hasClass('bodyclick')) {
            $('.chat-box').fadeOut(200)
            $('.chat-box').removeClass('bodyclick')
            $('.chat-box').removeClass('open')
        }
    });
    $('#close_chat').click(function () {
        $('.chat-box').removeClass('open')
        $('.chat-box').removeClass('bodyclick')
        $('.chat-box').fadeOut(200)
    })

    $('.minimize').click(function () {
        $('.chat-box').fadeOut(200)
        $('.chat-box').removeClass('open')
        $('.chat-box').removeClass('bodyclick')
    })

    $('.__ican-chat-iframe').on('load', function () {
        $('.loading').css({
            'display': 'none'
        })
    });

    function chat_body() {
        var chat_body = `<div class="chat-container chat-box" themes="default"></div>`;
        $(document.body).append(chat_body);
    }

    function chat_button() {
        var button = `<div class="chat-circle open-chat-box __chatclass" id="open_chat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
                            </svg>
                        </div>`;

        $(document.body).append(button);
    }

    function iframe() {

        var color = $('.chat-box').attr('themes');

        switch (color) {
            case 'default':
                color = '#1966a9'
                break;

            default:
                break;
        }

        var url_string = window.location.href;
        var url = new URL(url_string);
        var remote_url = url.searchParams.get("hostname") || window.location.host;

        var iframe = `<div class="minimize">
                    <img src="https://ican4consumers.com/chat/cdn/minus-solid.svg" id="minimize-chat-ic4c" class="" alt="minimize">
                    </div>
                    <iframe class="__ican-chat-iframe" src="https://chat.ican4consumers.com/client/ican?hostname=` + remote_url + `&color=` + encodeURIComponent(color) + `" frameborder="0"></iframe>`;

        $('.__chatclass').css({
            'background-color': color
        })
        $('.chat-box').append(iframe);
    }

    function load_chatbox() {
        var loading = `<div id="loadchat" class="loading">
                            <div class="loading-content">
                                <img src="https://ican4consumers.com/chat/cdn/ZZ5H.gif" id="loading-chat-ic4c" class="" alt="loading">
                            </div>
                        </div>`
        $('.chat-box').append(loading);
    }
})
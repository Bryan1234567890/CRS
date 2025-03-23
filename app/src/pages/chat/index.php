<div class="chat-circle open-chat-box" id="open_chat">

    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"></path>
    </svg>

</div>
<style>
    .minimize{
        visibility: visible !important;
        position: absolute;
        top: 10px;
        left: 20px;
        color: #fff;
        cursor: pointer;
    }
</style>


<div class="chat-container chat-box ">
        <div class="minimize">
        <i class="fa fa-window-minimize fa-1x"></i>
        </div>
        <!-- <iframe class="" src="https://refund4u.net:8000/icanclient" frameborder="0"></iframe> -->
        <iframe class="" src="https://devstaging.mybizbox.us/AgentChat/client/ican" frameborder="0"></iframe>
    
    <!--
    <div class="chat-content">
        <div class="chat-header ">
            <div class="user flex">
                <div class="avatar">
           
                    <img src="./public/images/profile.png" alt="">
                </div>
                <div class="name">Mark John Paul</div>
            </div>
            <div class="bar-tool">
                <span class="chat-close-btn" id="close_chat">&times;</span>
            </div>

        </div>

        <div class="chat-logs">

            <div class="chat-msg user">
                <div class="avatar">
                    <img src="./public/images/profile.png" alt="">
                </div>
                <div class="chat-bubble">
                    Hi , Welocome to iCAN4CONSUMERS Chat, How may i help you?</div>
            </div>


            <div class="chat-msg self">
                <div class="avatar">
                    <img src="./public/images/programmer.png" alt="">
                </div>
                <div class="chat-bubble">
                    I dont't know to use the product
                </div>
            </div>

        </div>

        <div class="chat-message flex">
            <textarea rows='' placeholder="Write message"></textarea>
            <span class="btn-send"><i class="fa fa-paper-plane fa-2x"></i></span>
        </div>
    </div>
-->
</div>
<!-- 
<style>
    @import url('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');

.cookie-alert {
  position: fixed;
  bottom: 15px;
  right: 15px;
  width: 320px;
  margin: 0 !important;
  z-index: 999;
  opacity: 0;
  transform: translateY(100%);
  transition: all 500ms ease-out;
}

.cookie-alert.show {
  opacity: 1;
  transform: translateY(0%);
  transition-delay: 1000ms;
}
</style>


<div class="card cookie-alert " id="cookies">
  <div class="card-body">
    <h5 class="card-title">&#x1F36A; Do you like cookies?</h5>
    <p class="card-text">We use cookies to ensure you get the best experience on our website.</p>
    <div class="btn-toolbar justify-content-end">
      <a href="http://cookiesandyou.com/" target="_blank" class="btn btn-link">Learn more</a>
      <a href="#" class="btn btn-primary Enabled-cookies">Enabled</a>
    </div>
  </div>
</div>


<script>

$(document).ready(function() {

    var cookieEnabled = navigator.cookieEnabled;

    if (!navigator.cookieEnabled) {
        // $('#cookies').addClass('show');
    }
    else{
        $('#cookies').addClass('show');
    }
  

  

});
$('.Enabled-cookies').click(function() {

    //  var cookieEnabled = navigator.cookieEnabled;
    //  cookieEnabled
    //  console.log(cookieEnabled);

//   $.cookie(
//     'cookies',
//     'ok', {
//       expires: 365,
//       path: '/'
//     }
//   );
  $('#cookies').removeClass('show');
});
</script> -->

let chat = (function(){
  

    $('#open_chat').click(function(){
        $('.chat-box').addClass('open')
    })
    
    $('#close_chat').click(function(){
        $('.chat-box').removeClass('open')
    })
    
    $('.minimize').click(function(){
        $('.chat-box').removeClass('open')
    })
       

})()

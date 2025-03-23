let $OpenChat = $('#OpenchatBtn');
let $CloseChat= $("#MinimizedChatBtn");


// Open chat box container
OpenChat.click((e)=>{
    e.preventDefault();

});



// Minimized chat box container

CloseChat.click((e) => {
  e.preventDefault();

});


const OpenChatBox = {
  init: () => {
    OpenChatBox.trgger();
  },
  trgger: () => {

  },
};


const CloseChatBox = {
  init: () => {},
  trgger: () => {},
};
    

const CHAT = (()=>{

    OpenChatBox.init();

})();

// const CHAT = {
//   init: () => {

//   },

//   openChatBox: () => {

//   },

//   minimizedChatBox: () => {

//   },

//   ResetChatBox:() =>{

//   }
// };

"use strict";
var liveOrders=null;

function getLiveOrders(){
  axios.get('/liveapi').then(function (response) {
    liveOrders.neworders=response.data.neworders;
    liveOrders.accepted=response.data.accepted;
    liveOrders.done=response.data.done;
    liveOrders.calculateBiggest()
    
  })
  .catch(function (error) {
    
  });
};

window.onload = function () {

    var audio = new Audio('https://mobidonia.com/wp-content/sound/bell.mp3');
    var welcomeAudio = new Audio('https://mobidonia.com/wp-content/sound/pop.mp3');

    //VUE CART
    liveOrders = new Vue({
      el: '#liveorders',
      data: {
        neworders: [],
        accepted: [],
        done:[],
        biggestBefore:null,
      },
      methods:{
        calculateBiggest(){
          if(this.biggestBefore==null){
            //initial -- loop over the neworders to find the biggest it
            
            this.biggestBefore=this.findBiggest();
            
            welcomeAudio.play();
          }else{
            //on update
            //Find biggest
            
            var newBiggest=this.findBiggest();
            if(newBiggest>this.biggestBefore){
              //Set new biggest
              
              this.biggestBefore=newBiggest;
              
              audio.play();
            }else{
              
            }
          }
        },
        findBiggest(){
          var biggest=0;
          this.neworders.forEach(element => {
            if(element.id>biggest){
              biggest=element.id;
            }
          });
          return biggest;
        }
      }
    })

    getLiveOrders();
    setInterval(getLiveOrders, 10000);

}
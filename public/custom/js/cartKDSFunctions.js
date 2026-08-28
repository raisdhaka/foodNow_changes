"use strict";
var orderContent=null;
var showFinishedOrders="false";

// Maps color names to modern color schemes
const colorMap = {
    'red': { backgroundColor: '#FED7D7', color: '#822727' },
    'orange': { backgroundColor: '#FEEBC8', color: '#744210' },
    'yellow': { backgroundColor: '#FEFCBF', color: '#744210' },
    'green': { backgroundColor: '#C6F6D5', color: '#22543D' },
    'blue': { backgroundColor: '#BEE3F8', color: '#2A4365' },
    'purple': { backgroundColor: '#E9D8FD', color: '#44337A' },
    'pink': { backgroundColor: '#FED7E2', color: '#702459' }
};

function getAllOrders(){
    axios.get('/api/v2/kds/orders/'+showFinishedOrders+'?api_token='+TOKEN).then(function (response) {
      console.log("Data received");
      orderContent.items=response.data.data;
     })
     .catch(function (error) {
       console.log(error);
     });
  }

  function doFinishItem(orderID,itemID,isFromDbOrder,call="finishItem"){
    console.log(call+itemID);
    axios.get('/api/v2/kds/orders/'+call+'/'+orderID+'/'+itemID+'/'+(isFromDbOrder?"true":"false")+'?api_token='+TOKEN).then(function (response) {
        console.log("Item finished");
        getAllOrders();
     })
     .catch(function (error) {
       console.log(error);
     });
  }

  function doFinishUnfinishOrder(orderID,isFromDbOrder,call="finishOrder"){
    console.log(call+orderID);
    axios.get('/api/v2/kds/orders/'+call+'/'+orderID+'/'+(isFromDbOrder?"true":"false")+'?api_token='+TOKEN).then(function (response) {
        console.log("Order finished");
        getAllOrders();
     })
     .catch(function (error) {
       console.log(error);
     });
  }

  function showActive(){
    showFinishedOrders="false";
    $('#activeOrders').hide();
    $('#finishedOrders').show();
    getAllOrders();
  }

  function showFinished(){
    showFinishedOrders="true";
    $('#activeOrders').show();
    $('#finishedOrders').hide();
    getAllOrders();
  }

window.onload = function () {
orderContent = new Vue({
    el: '#orderList',
    data: {
      items: [],
      colorStyles: colorMap
    },
    methods: {
        finishItem: function (orderID,itemID,isFromDbOrder) {
            doFinishItem(orderID,itemID,isFromDbOrder);
        },
        unfinishItem: function (orderID,itemID,isFromDbOrder) {
            doFinishItem(orderID,itemID,isFromDbOrder,"unfinishItem");
        },
        finishOrUnfinishOrder: function (orderID,isFromDbOrder,isFinished) {
            doFinishUnfinishOrder(orderID,isFromDbOrder,isFinished=="1"?"unfinishOrder":"finishOrder");
        },
        getHeaderStyle: function(colorString) {
            // Extract color name from the background-color string
            const match = colorString.match(/background-color:(\w+)/);
            if (!match) return { padding: '16px' };
            
            const colorName = match[1];
            const style = this.colorStyles[colorName] || {};
            
            // Add padding to the style
            return {
                ...style,
                padding: '16px'
            };
        }
    }
  });
  
  setTimeout(() => {
    getAllOrders();
  }, 1000);
};
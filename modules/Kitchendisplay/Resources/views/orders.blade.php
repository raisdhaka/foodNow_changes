<div id="orderList" class="d-flex justify-content-start p-2 flex-wrap">
    <div class="card shadow-sm" style="max-width: 280px; margin-right:16px; margin-bottom:16px; border-radius:12px; border:none;" v-for="order in items" v-cloak>
        <div class="card-header p-0 z-index-1" style="border-top-left-radius:12px; border-top-right-radius:12px;">
          <a v-on:click="finishOrUnfinishOrder(order.id,order.isFromDbOrder,order.kds_finished)" class="d-block" >
            <div class="order-header" v-bind:class="[
              order.header.color.includes('red') ? 'bg-red' : '',
              order.header.color.includes('orange') ? 'bg-orange' : '',
              order.header.color.includes('yellow') ? 'bg-yellow' : '',
              order.header.color.includes('green') ? 'bg-green' : '',
              order.header.color.includes('blue') ? 'bg-blue' : '',
              order.header.color.includes('purple') ? 'bg-purple' : '',
              order.header.color.includes('pink') ? 'bg-pink' : ''
            ]">
                <p class="text-uppercase font-weight-bold mb-1">
                    @{{order.header.title1}}
                </p>
                <p class="text-sm font-weight-bold mb-1">
                    @{{order.header.title2}}
                </p>
                <p class="text-sm font-weight-bold mb-0">
                    @{{order.header.title3}}
                </p>
            </div>
          </a>
        </div>
      
        <div class="card-body pt-3 pb-3 px-4">
          <p class="card-description mb-2" v-for="cartdata in order.cart_data" v-cloak>
            <span v-on:click="finishItem(order.id,cartdata.id,order.isFromDbOrder)" v-if="cartdata.kds_finished==0" class="item-entry">@{{cartdata.quantity}} x @{{cartdata.name}}</span>
            <span v-on:click="unfinishItem(order.id,cartdata.id,order.isFromDbOrder)" class="item-entry completed" v-if="cartdata.kds_finished==1">@{{cartdata.quantity}} x @{{cartdata.name}}</span>
          </p>
          <div v-if="order.comment.length>2" class="mt-3">
            <hr style="margin-top:4px; margin-bottom:10px; border-color:#E2E8F0;" />
            <p class="card-description mb-0 text-muted" style="font-size: 0.85rem;">
                @{{order.comment}}
            </p>
          </div>
        </div>
    </div>
</div>

<style>
    .card-description {
        font-size: 0.9rem;
        color: #4A5568;
        line-height: 1.5;
    }
    .item-entry {
        cursor: pointer;
        transition: all 0.2s;
        display: block;
        padding: 4px 0;
    }
    .item-entry:hover {
        color: #2D3748;
    }
    .item-entry.completed {
        text-decoration: line-through;
        color: #A0AEC0;
    }
    .order-header {
        padding: 16px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    /* Modern color schemes */
    .bg-red {
        background-color: #FED7D7;
        color: #822727;
    }
    .bg-orange {
        background-color: #FEEBC8;
        color: #744210;
    }
    .bg-yellow {
        background-color: #FEFCBF;
        color: #744210;
    }
    .bg-green {
        background-color: #C6F6D5;
        color: #22543D;
    }
    .bg-blue {
        background-color: #BEE3F8;
        color: #2A4365;
    }
    .bg-purple {
        background-color: #E9D8FD;
        color: #44337A;
    }
    .bg-pink {
        background-color: #FED7E2;
        color: #702459;
    }
</style>
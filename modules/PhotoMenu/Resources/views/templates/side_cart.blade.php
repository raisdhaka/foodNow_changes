<div class='info pt-1' >
    <div class='box-infos bg-white p-3 shadow-lg hover:shadow-xl rounded-lg'>
        <div class='head align-left mt-2'>
            <p class="text-lg  text-slate-700 font-bold mb-4"><strong>{{ __('Cart') }}</strong></p>
            
        </div>

        <div class='content' id="{{$id}}">
            
                <div v-for="item in items" class="items col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                    <div class=" clearfix mt-2" v-cloak>
                        
                        <h6 class="product-item_title">@{{ item.name }}</h6>
                        <p class="product-item_quantity">@{{ item.quantity }} x @{{ item.attributes.friendly_price }}</p>
                        
                        
                        <div class="d-flex flex-row-reverse mb-2">

                            <button type="button" v-on:click="remove(item.id)" :value="item.id" class="focus:outline-none hover:text-red-500 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                            <button type="button" v-on:click="incQuantity(item.id)" :value="item.id" class="focus:outline-none hover:text-green-500 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                            <button type="button" v-on:click="decQuantity(item.id)" :value="item.id" class="focus:outline-none hover:text-gray-500 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                        </div>
                        <hr />

                    </div>
                </div>
        </div>

        <div id="{{ $idtotal }}">
            <div v-if="totalPrice==0" class='head align-center'>
                <p class="text-center">{{ __('Cart is empty') }}</p>
            </div>
            <div v-if="totalPrice" class='actionsCart mt-2'>
                <span v-if="totalPrice"><strong>{{ __('Subtotal') }}:</strong></span>
                <span v-if="totalPrice" class="ammount"><strong>@{{ totalPriceFormat }}</strong></span>
                <br /><br />
                <a href="/cart-checkout" class='button full-button'>{{ __('Checkout') }}</a>
            </div>
        </div>
    </div>
</div> 
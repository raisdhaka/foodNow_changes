<div style="display: none" class="container-fluid py-2" id="aiOrders">
    <div class="row">
        <div class="col-12 col-xl-12 mt-3">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-7">
                            <h6>{{__('AI Orders')}}</h6>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="aiOrderList">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Created At') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Type') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Customer') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('Phone') }}</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="aiOrderList" v-if="aiItems && aiItems.length">
                            <tr v-cloak class="mt-3 aiOrderRow" v-for="item in aiItems" :key="item.id">
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold">@{{ new Date(item.created_at).toLocaleString() }}</span>
                                </td>
                                <td>
                                    <span v-if="item.type == 1" class="badge badge-sm bg-gradient-success">{{ __('Delivery') }}</span>
                                    <span v-else class="badge badge-sm bg-gradient-info">{{ __('Takeaway') }}</span>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">@{{ item.customer_name }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">@{{ item.customer_phone }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <button v-if="!item.processed" 
                                            class="btn btn-sm bg-gradient-primary" 
                                            @click.stop="processAiOrder(item)">
                                        {{ __('Process') }}
                                    </button>
                                    <button v-if="item.processed" 
                                            class="btn btn-sm bg-gradient-success" 
                                            @click.stop="processAiOrder(item)">
                                        {{ __('Processed') }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <p class="text-sm mb-0">{{ __('No AI orders found') }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
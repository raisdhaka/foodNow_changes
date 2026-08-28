<div class="col-md-6">
    @include('partials.input',['name'=>'MercadoPago Pricing Plan ID','id'=>"subscribe[paypal_id]",'placeholder'=>"Product price plan id from MercadoPago",'required'=>false,'value'=>(isset($plan)?$plan->paypal_id:null)])
</div>
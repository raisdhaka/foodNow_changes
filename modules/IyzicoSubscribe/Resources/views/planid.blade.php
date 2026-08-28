<div class="col-md-6">
    @include('partials.input',['name'=>'Izyco Plan ID','id'=>"subscribe[paddle_id]",'placeholder'=>"Izyco Plan ID here...",'required'=>false,'value'=>(isset($plan)?$plan->paddle_id:null)])
</div>
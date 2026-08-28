<div class="col-md-6">
    @include('partials.input',['name'=>'Paddle ID','id'=>"subscribe[paddle_id]",'placeholder'=>"Paddle ID here, Starts with pri_",'required'=>false,'value'=>(isset($plan)?$plan->paddle_id:null)])
</div>
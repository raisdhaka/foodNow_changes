
@if(auth()->user()->hasRole('admin')
    ||
    ((auth()->user()->hasRole('owner')||auth()->user()->hasRole('staff'))&&config('status.isForVendor',false))
    )
    <div class="card card-profile shadow mt-4">
        <div class="card-header">
            <h5 class="h3 mb-0">{{ __("Update order status")}}</h5>
        </div>
        <div class="card-body">
            <form  method="POST" action="{{ route('status.update',['order'=>$order->id]) }}">
            @csrf()
            @include('partials.select',[
                'id'=>"status",
                'data'=>$statuses,
                'name'=>"Status"
            ])
            <button class="btn btn-success" type="submit">{{__('Save')}}</button>
            </form>
        </div>
        
    </div>
@endif

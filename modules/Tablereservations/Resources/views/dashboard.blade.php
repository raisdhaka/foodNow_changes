@hasrole('owner')




<div class="mt-4">
    <a href="{{ route('tablereservations.create') }}" type="button" class="btn btn-outline-primary ">📅 {{ __('Make reservation')}}</a>
    <a href="{{ route('tablereservations.create') }}?status=seated" type="button" class="btn btn-outline-primary ">🚶 {{ __('Add walk in')}}</a>
    <a href="{{ route('contacts.create') }}" type="button" class="btn btn-outline-primary ">🪪  {{ __('Create customer')}}</a>
</div>
@include('partials.infoboxes.advanced',['collection'=>$tablereservations])
@endhasrole


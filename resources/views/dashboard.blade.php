@php
    $isRpro = config('settings.app_code_name') === 'rpro';
    $isOwner = auth()->user()->hasRole('owner');
@endphp

@if($isRpro && ($isOwner || Auth::user()->isImpersonating()))
    @include('dashboardv2')
@else
    @include('dashboardv1')
@endif 
@extends('layouts.app', ['title' => __('Apps')])

@section('content')
<div class="header bg-gradient-default pb-6 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-3" id="list-container">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body p-0">
                    <div class="p-3" id="search-container">
                        <div class="input-group input-group-merge rounded-pill shadow-sm hover-shadow-lg transition-shadow duration-200 bg-white border-0">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search text-primary opacity-75"></i>
                            </span>
                            <input type="text" 
                                   id="navSearch" 
                                   class="form-control form-control-flush bg-transparent border-0 px-3"
                                   placeholder="{{ __('Search apps...') }}"
                                   style="font-size: 0.95rem">
                            <span class="input-group-text bg-transparent border-0 d-none" id="clearSearch">
                                <i class="fas fa-times-circle text-muted cursor-pointer"></i>
                            </span>
                        </div>
                    </div>
                    <ul class="ml-3 nav nav-pills nav-flush flex-column" id="tabs-icons-text" role="tablist">
                        @foreach ($separators as $separator)
                            <li class="nav-item mt-2">
                                <a class="nav-link btn-secondary px-4 @if ($loop->first) active @endif" 
                                   id="{{$separator['snake']."_tab"}}" 
                                   data-toggle="tab" 
                                   href="#{{$separator['snake']}}" 
                                   role="tab" 
                                   aria-controls="{{$separator['snake']}}" 
                                   aria-selected="true">
                                    <i class="{{$separator['icon']}} me-3 mr-3"></i>
                                    <span class="ms-2">{{ __($separator['name']) }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9" id="form-container">
            @include('partials.flash')
            <form id="restorant-apps-form" method="post" autocomplete="off" enctype="multipart/form-data" action="{{ route('admin.owner.updateApps',$company) }}">
                @csrf
                @method('put')
                <div class="card shadow-sm rounded-lg">
                    <div class="card-body p-4">
                        <div class="tab-content" id="myTabContent">
                            @foreach ($separators as $separator)
                                <div class="tab-pane fade show @if ($loop->first) active @endif" 
                                     id="{{ $separator['snake'] }}" 
                                     role="tabpanel" 
                                     aria-labelledby="{{ $separator['snake'] }}">
                                    @include('partials.fields',['fields'=>$separator['fields']])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4 px-5 py-2 rounded-pill">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#navSearch').on('keyup', function() {
           //Implement search
           var searchTerm = $('#navSearch').val();
           console.log(searchTerm);
           $('#tabs-icons-text .nav-link').each(function() {
               if ($(this).text().toLowerCase().includes(searchTerm.toLowerCase())) {
                   $(this).show();
               } else {
                   $(this).hide();
               }
           });
        });

        //If we have ?search= then we show the search results
        if (window.location.search.includes('?search=')) {
            var activeTab = window.location.search.split('=')[1];

            //Remove active class from all form containers
            $('.tab-pane').removeClass('active');

            if (activeTab === 'payments') {
                // Show all payment-related tabs
                const paymentTabs = [
                    'smercadopago_configuration',
                    'paypal_configuration',
                    'stripe_configuration',
                    'payfast_configuration',
                    'paystack_configuration',
                    'razorppay_configuration',
                    'iyzico_configuration'
                ];

                // Check if any payment tab exists
                let tabExists = false;
                paymentTabs.forEach(tab => {
                    if ($('#' + tab + '_tab').length > 0) {
                        $('#' + tab + '_tab').addClass('active');
                        $('#' + tab).addClass('show active');
                        tabExists = true;
                    }
                });

                // If no payment tabs exist, show an info message
                if (!tabExists) {
                    // Create an info alert
                    const infoMessage = '<div class="alert alert-info" role="alert"><i class="fas fa-info-circle mr-2"></i>We are handling the payments. There is no configurations needed.</div>';
                    
                    // Insert the message at the top of the form container
                    $('#form-container .card .card-body').prepend(infoMessage);

                    //Hide the save button
                    $('#restorant-apps-form .btn-success').hide();
                }
            } else {
                //Set active tab for non-payment searches
                $('#' + activeTab + '_tab').addClass('active');
                $('#' + activeTab).addClass('show active');
            }

            //Hide the list container
            $('#list-container').addClass('d-none');

            //Expand form container, set col-12
            $('#form-container').removeClass('col-xl-9').addClass('col-12');
        }
    });
</script>
@endsection





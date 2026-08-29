@extends('layouts.app', ['title' => __('Settings')])
@section('js')
<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
<script type="text/javascript">
	Paddle.Setup({ 
        vendor: 49978,
         });
</script>
<script>
    var  email="{{ auth()->user()->email}}";
    function openPaddle(id){
        Paddle.Checkout.open({
			product: id,
			email: email
		});
    }
    function openPaddleDiscount(id,coupon){
        Paddle.Checkout.open({
			product: id,
			email: email,
            coupon: coupon
		});
    }
    function showPlugins(filterPlugins){
        $('.plugin-all').hide();
        var toShow='.plugin-'+filterPlugins;
        $(toShow).show();
    }
</script>
@endsection
@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="mb-0">{{ __('Apps') }}</h3>
                            
                        </div>
                        @if (config('settings.is_demo') | config('settings.is_demo')) 
                        <div class="col-6 text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="form-group mb-0 mr-3" style="min-width: 300px;">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input class="form-control" id="appsSearch" placeholder="{{ __('Search apps...') }}" type="text">
                                    </div>
                                </div>
                                <button onclick="showUpdates()" class="btn btn-info mr-3" id="showUpdatesBtn">
                                    <i class="fas fa-sync-alt mr-1"></i> {{ __('Show Updates') }}
                                    <span class="badge badge-white ml-1 text-dark" id="updateCount">0</span>
                                </button>
                                <a onclick="alert('Disabled in demo')" class="btn btn-success text-white">{{ __('Upload plugin') }}</a>
                            </div>
                        </div>
                        @else
                            <div class="col-6 text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="form-group mb-0 mr-3" style="min-width: 300px;">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input class="form-control" id="appsSearch" placeholder="{{ __('Search apps...') }}" type="text">
                                        </div>
                                    </div>
                                    <button onclick="showUpdates()" class="btn btn-info mr-3" id="showUpdatesBtn">
                                        <i class="fas fa-sync-alt mr-1"></i> {{ __('Show Updates') }}
                                        <span class="badge badge-white ml-1" id="updateCount">0</span>
                                    </button>
                                    <a onclick="$('#appupload').click();" class="btn btn-success text-white">{{ __('Upload plugin') }}</a>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
                <div class="card-body">
                    
                    <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 active" onclick="showPlugins('all')" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">{{ __('All') }}</a>
                        </li>
                         <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0"  onclick="showPlugins('installed')" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">{{ __('Installed') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0"  onclick="showPlugins('tools')" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">{{ __('Tools') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0"  onclick="showPlugins('themes')" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-t" role="tab" aria-controls="tabs-text-t" aria-selected="false">{{ __('Themes')}}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0"  onclick="showPlugins('payments')"  id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">{{ __('Payments') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" onclick="showPlugins('subscriptions')" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">{{ __('Subscriptions') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" onclick="showPlugins('apps')" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">{{ __('Mobile apps') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" onclick="showPlugins('community')" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">{{ __('Community') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0"  onclick="showPlugins('free')" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">{{ __('Free') }}</a>
                        </li>
                      </ul>
                      <hr />
                    
                    @include('partials.flash')
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div style="display: none">
                            <input name="appupload" type="file" class="" id="appupload" accept=".zip,.rar,.7zip"   onchange="form.submit()">
                        </div>
                    </form>

                    <script>
                        // Search functionality
                        document.getElementById('appsSearch').addEventListener('input', function(e) {
                            const searchTerm = e.target.value.toLowerCase();
                            filterApps(searchTerm);
                        });

                        // Updates functionality
                        let showingUpdates = false;
                        
                        function countUpdates() {
                            let count = 0;
                            document.querySelectorAll('.plugin-all').forEach(function(app) {
                                if (app.querySelector('.btn-outline-primary[href*="New update"]')) {
                                    count++;
                                }
                            });
                            document.getElementById('updateCount').textContent = count;
                            return count;
                        }

                        function showUpdates() {
                            showingUpdates = !showingUpdates;
                            const btn = document.getElementById('showUpdatesBtn');
                            
                            if (showingUpdates) {
                                btn.classList.remove('btn-info');
                                btn.classList.add('btn-warning');
                                document.querySelectorAll('.plugin-all').forEach(function(app) {
                                    if (app.querySelector('.btn-outline-primary[href*="New update"]')) {
                                        app.style.display = '';
                                    } else {
                                        app.style.display = 'none';
                                    }
                                });
                            } else {
                                btn.classList.remove('btn-warning');
                                btn.classList.add('btn-info');
                                document.querySelectorAll('.plugin-all').forEach(function(app) {
                                    app.style.display = '';
                                });
                            }
                        }

                        function filterApps(searchTerm = '') {
                            document.querySelectorAll('.plugin-all').forEach(function(app) {
                                const title = app.querySelector('.card-title').textContent.toLowerCase();
                                const description = app.querySelector('.card-text').textContent.toLowerCase();
                                const hasUpdate = showingUpdates ? app.querySelector('.btn-outline-primary[href*="New update"]') : true;
                                
                                if ((title.includes(searchTerm) || description.includes(searchTerm)) && (hasUpdate || !showingUpdates)) {
                                    app.style.display = '';
                                } else {
                                    app.style.display = 'none';
                                }
                            });
                        }

                        // Initialize update count
                        document.addEventListener('DOMContentLoaded', function() {
                            countUpdates();
                        });
                    </script>

                    <div class="row">
                        @if(empty($apps))
                        <p>
                            {{ __("There are no apps at the moment")}}
                        </p>
                        @endif
                        @foreach ($apps as $app)
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mt-3 plugin-all @if ($app->installed) {{ 'plugin-installed'}} @endif <?php  foreach ($app->category as $cat){echo "plugin-".$cat." ";} ?>">
                            <div class="card" style="width: 18rem;">
                                @if(isset($app->image) && $app->image)

                                    <img class="card-img-top" src="{{ $app->image ?? '' }}" alt="{{ $app->name ?? '' }}">
                                @endif
                                <div class="card-body">
                                <h5 class="card-title">{{ $app->name }} - {{ $app->price }} @if ($app->installed)<span class="small text-green">{{ __('installed')}} v{{$app->version}}</span>@endif</h5>
                                <p class="card-text">{{ $app->description }}</p>
                                
                                @if ($app->installed)
                                    <!-- APP IS IN LOCAL SYSTEM -->
                                    <a href="{{ route('settings.index') }}" class="mt-1 btn btn-sm btn-outline-success"><span class="btn-inner--icon"><i class="fas fa-cog"></i></span>   {{ __('Settings')}}</a>
                                    @if ($app->updateAvailable&&isset($app->file))
                                        @if (!config('settings.is_demo',false))
                                            <a target="_blank" href="{{ $app->file }}" class="mt-1 btn btn-sm btn-outline-primary"><span class="btn-inner--icon"><i class="fas fa-refresh"></i></span>   {{ __('New update')}} v{{$app->latestVersion}}</a>
                                        @endif
                                    @endif
                                    
                                    <a onclick="return confirm('Are you sure?')" href="{{ route('apps.remove',[$app->alias]) }}" class="mt-1 btn btn-sm btn-outline-danger"><span class="btn-inner--icon"><i class="fas fa-trash"></i></span>  {{ __('Delete')}}</a>
                                    <!-- @if ($app->price=="Free")
                                        <p class="card-text mt-2">{{__('Price')}}: 0$</p>
                                    @else
                                        <p class="card-text mt-2">{{__('Price')}}: {{ $app->price }}</p>
                                    @endif -->
                                @else
                                
                                    <!-- APP IS NOT IN LOCAL SYSTEM -->
                                    
                                    @if (isset($app->file))
                                        @if (!config('settings.is_demo',false))
                                            <!-- WE HAVE Access to the file. This is all access pass -->
                                            <a href="{{$app->file}}" target="_blank"  class="mt-1 btn btn-sm btn-outline-primary"><span class="btn-inner--icon"><i class="fas fa-download"></i></span>   {{ __('Download') }}</a>  
                                        @endif
                                        
                                    @else
                                        <!-- WE don't HAVE Access to the file.  -->
                                        @if (isset($app->paddle))
                                            @if (isset($app->discount_code))
                                                <a  onclick="openPaddleDiscount('{{$app->paddle}}','{{$app->discount_code}}')" class="mt-1 btn btn-sm btn-outline-primary"><i class="fas fa-shopping-cart"></i></span>  {{ __('Buy with discount')." - ".$app->price }}</a>
                                            @else
                                                <a  onclick="openPaddle({{$app->paddle}})" class="mt-1 btn btn-sm btn-outline-primary"><span class="btn-inner--icon"><i class="fas fa-shopping-cart"></i></span>  {{ __('Buy now')." - ".$app->price }}</a>  
                                            @endif
                                        @elseif(isset($app->link)&&strlen($app->link)>3)
                                            <!-- Outside link like CodeCanyon -->
                                            <a target="_blank" href="{{ $app->link }}" class="mt-1 btn btn-sm btn-outline-primary"><span class="btn-inner--icon"><i class="fas fa-shopping-cart"></i></span> {{ __('Buy now')." - ".$app->price }}</a>
                                        @endif


                                        @if (isset($app->ppfolder))
                                            <a target="_blank"  href="{{$app->ppfolder}}" class="mt-1 btn btn-sm btn-outline-primary"><span class="btn-inner--icon"><i class="fas fa-download"></i></span>  {{ __('Download update') }}</a>  
                                        @endif

                                        
                                        
                                    @endif
                               
                                @endif

                                @if (isset($app->docs))
                                    <a href="{{$app->docs}}" target="_blank" class="mt-1 btn btn-sm btn-outline-info"><span class="btn-inner--icon"><i class="fas fa-file-pdf"></i></span> {{ __('Docs') }}</a>
                                @endif

                                @if (isset($app->video))
                                    <a href="{{$app->video}}" target="_blank" class="mt-1 btn btn-sm btn-outline-danger"><span class="btn-inner--icon"><i class="fas fa-video"></i></span> {{ __('Video') }}</a>
                                @endif

                                @if (isset($app->demo))
                                    <a href="{{$app->demo}}" target="_blank" class="mt-1 btn btn-sm btn-outline-primary"><span class="btn-inner--icon"><i class="fas fa-eye"></i></span> {{ __('Demo') }}</a>
                                @endif
                                
                                </div>
                            </div>  
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
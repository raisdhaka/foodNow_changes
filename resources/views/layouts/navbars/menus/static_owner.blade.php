@php
    $currentRouteName = \Request::route()->getName();
@endphp

<!-- Account Section -->
<div class="user-account-section">
    <div class="d-flex align-items-center rounded p-3 mt--3 mb-2" style="background-color: #f8f9fa;">
        <div class="flex-grow-1 min-width-0 mr-3">
            <h5 class="text mb-0 text-truncate">{{ auth()->user()->name }}</h5>
            <small class="d-block text-truncate">{{ auth()->user()->email }}</small>
        </div>
        <div class="dropdown flex-shrink-0">
            <a class="btn btn-link text-black p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#111827" class="size-24" style="width: 24px; height: 24px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="ni ni-single-02 mr-2"></i>{{ __('Profile') }}
                </a>
                <a class="dropdown-item" href="{{ route('plans.current')}}">
                    <i class="ni ni-money-coins mr-2"></i>{{ __('Billing') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ni ni-user-run mr-2"></i>{{ __('Logout') }}
                </a>
            </div>
        </div>
    </div>
</div>


<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ $currentRouteName == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
        </a>
    </li>
</ul>


<!-- Workflow -->
<hr class="my-3">
<h6 class="navbar-heading p-0 text-muted">
    <span class="docs-normal">{{__('Workflow')}}</span>
</h6>
<ul class="navbar-nav">

    <a class="nav-link {{ in_array($currentRouteName, ['orders.index','orders.show', 'live', 'kitchendisplay.index', 'poscloud.index', 'finances.owner']) ? 'active' : '' }}" href="#navbar-orders" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-orders">
        <i class="ni ni-cart text-primary"></i>
        <span class="nav-link-text">{{ __('Orders') }} </span>
    </a>
    <div class="collapse {{ in_array($currentRouteName, ['orders.index','orders.show', 'live', 'kitchendisplay.index', 'poscloud.index', 'finances.owner']) ? 'show' : '' }}" id="navbar-orders" style="">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a class="nav-link {{ $currentRouteName == 'orders.index' || $currentRouteName == 'orders.show' ? 'active' : '' }}" href="{{ route('orders.index') }}">
                    <i class="ni ni-basket text-orange"></i> {{ __('Orders') }}
                </a>
            </li> 
            <li class="nav-item">
                <a class="nav-link {{ $currentRouteName == 'live' ? 'active' : '' }}" href="/live">
                    <i class="ni ni-bell-55 text-success"></i> {{ __('Live Orders') }} <div class="blob red"></div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $currentRouteName == 'kitchendisplay.index' ? 'active' : '' }}" target="_blank" href="{{ route('kitchendisplay.index') }}">
                    <i class="ni ni-tv-2 text-info"></i> {{ __('KDS') }}
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ $currentRouteName == 'poscloud.index' ? 'active' : '' }}" target="_blank" href="{{ route('poscloud.index') }}">
                    <i class="ni ni-laptop text-primary"></i> {{ __('POS') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $currentRouteName == 'finances.owner' ? 'active' : '' }}" href="{{ route('finances.owner') }}">
                    <i class="ni ni-chart-bar-32 text-yellow"></i> {{ __('Reports') }}
                </a>
            </li>
        </ul>
    </div>

    <!-- Reservations -->
    <a class="nav-link {{ $currentRouteName == 'tablereservations.panel' ? 'active' : '' }}" href="{{ route('tablereservations.panel') }}" role="button">
        <i class="ni ni-calendar-grid-58 text-primary"></i>
        <span class="nav-link-text">{{ __('Reservations') }} </span>
    </a>

    <!-- AI Hub -->
    @if(config('settings.enable_ai_hub'))
    <a class="nav-link {{ $currentRouteName == 'aihub.index' ? 'active' : '' }}" href="{{ route('aihub.index') }}">
          <i class="ni ni-diamond text-primary"></i>
        <span class="nav-link-text">{{ __('AI Hub') }} </span>
    </a>
    @endif
    <!-- Mobile Apps -->
    @if(config('settings.enable_mobile_apps'))
    <a class="nav-link {{ $currentRouteName == 'mobileapps.index' ? 'active' : '' }}" href="{{ route('mobileapps.index') }}">
          <i class="ni ni-mobile-button text-primary"></i>
        <span class="nav-link-text">{{ __('Mobile Apps') }} </span>
    </a>
    @endif
    
</ul>

<!-- Restaurant -->
<hr class="my-3">
<h6 class="navbar-heading p-0 text-muted">
    <span class="docs-normal">{{__('Restaurant')}}</span>
</h6>
<ul class="navbar-nav ">
    <li class="nav-item">

        @if((auth()->user()->hasRole('owner')||auth()->user()->hasRole('staff'))&&!config('settings.is_pos_cloud_mode')&&!config('app.issd'))
            @if (auth()->user()->hasRole('owner'))
              <?php $urlToVendor=auth()->user()->restaurants()->get()->first()->getLinkAttribute(); ?>
            @endif  
            @if (auth()->user()->hasRole('staff'))
            <?php $urlToVendor=auth()->user()->restaurant->getLinkAttribute(); ?>
            @endif

            <a class="nav-link {{ $currentRouteName == 'vendor' ? 'active' : '' }}" target="_blank" href="{{ $urlToVendor }}">
                <i class="ni ni-planet text-info"></i> {{ __('Website') }}
            </a>
          @endif


        
    </li>

    
    <li class="nav-item">
        <a class="nav-link {{ in_array($currentRouteName, ['items.index', 'items.edit', 'qr', 'admin.restaurant.tables.index','floorplan.edit','admin.restaurant.restoareas.index', 'staff.index', 'admin.restaurant.simpledelivery.index', 'drivers.index', 'expenses.expenses.index', 'admin.restaurants.edit']) ? 'active' : '' }}" href="#navbar-restaurant" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-restaurant">
            <i class="ni ni-shop text-primary"></i>
            <span class="nav-link-text">{{ __('Restaurant') }}</span>
        </a>
        <div class="collapse {{ in_array($currentRouteName, ['themeswitcher.menu_design','photos.index','share.menu','items.index', 'items.edit', 'qr', 'admin.restaurant.tables.index','floorplan.edit', 'staff.index', 'admin.restaurant.simpledelivery.index', 'drivers.index', 'expenses.expenses.index', 'admin.restaurants.edit','admin.restaurant.restoareas.index']) ? 'show' : '' }}" id="navbar-restaurant">
            <ul class="nav nav-sm flex-column">
                
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'items.index' || $currentRouteName == 'items.edit' ? 'active' : '' }}" href="{{ route('items.index') }}">
                        <i class="ni ni-collection text-pink"></i> {{ __('Menu') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'qr' ? 'active' : '' }}" href="{{ route('qr') }}">
                        <i class="ni ni-mobile-button text-red"></i> {{ __('QR Builder') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.restaurant.tables.index' ||$currentRouteName == 'admin.restaurant.restoareas.index' || $currentRouteName == 'floorplan.edit' ? 'active' : '' }}" href="{{ route('admin.restaurant.tables.index') }}">
                        <i class="ni ni-ungroup text-red"></i> {{ __('Tables') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'photos.index' ? 'active' : '' }}" href="{{ route('photos.index') }}">
                        <i class="ni ni-camera-compact text-purple"></i> {{ __('Photos') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'themeswitcher.menu_design' ? 'active' : '' }}" href="{{ route('themeswitcher.menu_design') }}">
                        <i class="ni ni-palette text-info"></i> {{ __('Design') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{str_starts_with($currentRouteName, 'staff.') ? 'active' : '' }}" href="{{ route('staff.index') }}">
                        <i class="ni ni-single-02 text-orange"></i> {{ __('Staff') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.restaurant.simpledelivery.index' ? 'active' : '' }}" href="{{ route('admin.restaurant.simpledelivery.index') }}">
                        <i class="ni ni-pin-3 text-blue"></i> {{ __('Delivery Areas') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'drivers.index' ? 'active' : '' }}" href="{{ route('drivers.index') }}">
                        <i class="ni ni-delivery-fast text-green"></i> {{ __('Drivers') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'expenses.expenses.index' ? 'active' : '' }}" href="{{ route('expenses.expenses.index') }}">
                        <i class="ni ni-money-coins text-yellow"></i> {{ __('Expenses') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.restaurants.edit' ? 'active' : '' }}" href="{{ route('admin.restaurants.edit',  auth()->user()->restorant->id) }}">
                        <i class="ni ni-settings text-info"></i> {{ __('Management') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'social_networks_links' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=social_networks_links">
                        <i class="ni ni-world-2 text-blue"></i> {{ __('Social Networks') }}
                    </a>
                </li>

                <!-- Payment -->
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'payments' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=payments">
                        <i class="ni ni-credit-card text-info"></i> {{ __('Payments') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'custom_domain' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=custom_domain">
                        <i class="ni  ni-planet text-pink"></i> {{ __('Custom Domain') }}
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}">
                        <i class="ni ni-settings text-info"></i> {{ __('Configs') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'share.menu' ? 'active' : '' }}" href="{{ route('share.menu') }}">
                        <i class="ni ni-send text-green"></i> {{ __('Share') }}
                    </a>
                </li>

                
            </ul>
        </div>
    </li>
   
    <!-- Analytics -->
    <li class="nav-item">
        <a class="nav-link {{ $currentRouteName == 'analytics.index' ? 'active' : '' }}" href="{{ route('analytics.index') }}">
            <i class="ni ni-chart-pie-35 text-primary"></i>
            <span class="nav-link-text">{{ __('Analytics') }}</span>
        </a>
    </li>
</ul>


<!-- Customer Engagement & Loyalty -->
<hr class="my-3">
<h6 class="navbar-heading p-0 text-muted">
    <span class="docs-normal">{{__('Customer Engagement')}}</span>
</h6>
<ul class="navbar-nav ">
    <li class="nav-item">
        <a class="nav-link {{ in_array(\Request::route()->getName(), ['loyalty.cards.index', 'loyalty.give', 'loyalty.remove', 'loyaltyawards.index', 'loyaltyfaq.index', 'loyaltypoints.index']) ? 'active' : '' }}" href="#navbar-loyalty" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-loyalty">
            <i class="ni ni-credit-card text-primary"></i>
            <span class="nav-link-text">{{ __('Loyalty Program') }}</span>
        </a>
        <div class="collapse {{ in_array(\Request::route()->getName(), ['loyalty.cards.index', 'loyalty.give', 'loyalty.remove', 'loyaltyawards.index', 'loyaltyfaq.index', 'loyaltypoints.index']) ? 'show' : '' }}" id="navbar-loyalty">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'loyalty.cards.index' ? 'active' : '' }}" href="{{ route('loyalty.cards.index') }}">
                        <i class="ni ni-credit-card text-info"></i> {{ __('Cards') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'loyalty.give' ? 'active' : '' }}" href="{{ route('loyalty.give') }}">
                        <i class="ni ni-fat-add text-info"></i> {{ __('Give Points') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'loyalty.remove' ? 'active' : '' }}" href="{{ route('loyalty.remove') }}">
                        <i class="ni ni-credit-card text-orange"></i> {{ __('Redeem Points') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'loyaltyawards.index' ? 'active' : '' }}" href="{{ route('loyaltyawards.index') }}">
                        <i class="ni ni-trophy text-yellow"></i> {{ __('Awards') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'loyaltyfaq.index' ? 'active' : '' }}" href="{{ route('loyaltyfaq.index') }}">
                        <i class="ni ni-support-16 text-red"></i> {{ __('FAQ') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'loyaltypoints.index' ? 'active' : '' }}" href="{{ route('loyaltypoints.index') }}">
                        <i class="ni ni-chart-pie-35 text-green"></i> {{ __('Points Distribution') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'loyalty_program' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=loyalty_program">
                        <i class="ni ni-settings text-pink"></i> {{ __('Settings') }}
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link {{$currentRouteName == 'clients.index' ? 'active' : '' }}" href="{{ route('clients.index') }}">
            <i class="ni ni-circle-08 text-blue"></i> {{ __('Customers') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{$currentRouteName == 'coupons.index' ? 'active' : '' }}" href="{{ route('coupons.index') }}">
            <i class="ni ni-tag text-info"></i> {{ __('Coupons') }}
        </a>
    </li>
</ul>

<!-- Development -->
<hr class="my-3">
<h6 class="navbar-heading p-0 text-muted">
    <span class="docs-normal">{{__('Development')}}</span>
</h6>
<ul class="navbar-nav ">
    <li class="nav-item">
        <a class="nav-link" href="#navbar-integrations" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-integrations">
            <i class="ni ni-spaceship text-purple"></i>
            <span class="nav-link-text">{{ __('Integrations') }}</span>
        </a>
        <div class="collapse" id="navbar-integrations">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'whatsi.api' ? 'active' : '' }}" href="{{ route('whatsi.api') }}">
                        <i class="ni ni-bell-55 text-green"></i> WhatsApp
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentRouteName == 'admin.owner.apps' && request()->query('search') == 'detrack_configuration' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=detrack_configuration">
                        <i class="ni ni-delivery-fast text-pink"></i> {{ __('Detrack') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'web_hooks' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=web_hooks">
                        <i class="ni ni-world text-info"></i> {{ __('WebHooks') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'google_analytics' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=google_analytics">
                        <i class="ni ni-chart-bar-32 text-orange"></i> {{ __('Google Analytics') }}
                    </a>
                </li>
                 <!-- AI Hub -->
                 <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'open_a_i' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=open_a_i">
                        <i class="ni ni-diamond text-primary"></i> {{ __('Open AI') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$currentRouteName == 'admin.owner.apps' && request()->query('search') == 'print_node' ? 'active' : '' }}" href="{{ route('admin.owner.apps')}}?search=print_node">
                        <i class="ni ni-single-copy-04 text-primary"></i> {{ __('PrintNode') }}
                    </a>
                </li>
               
            </ul>
        </div>
    </li>
    <!--<li class="nav-item">
        <a class="nav-link" href="{{ config('settings.external_api_docs_url') }}" target="_blank">
            <i class="ni ni-app text-info"></i> {{ __('API') }}
        </a>
    </li>-->
</ul>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

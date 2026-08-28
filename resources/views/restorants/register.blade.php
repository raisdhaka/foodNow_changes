@extends('rpro.blog_master')
@if (strlen(config('settings.recaptcha_site_key'))>2)
    @section('head')
    {!! htmlScriptTagJsApi([]) !!}
    @endsection
@endif

@section('content')
    <section class="relative w-full bg-white relative bg-[linear-gradient(115deg,var(--tw-gradient-stops))] from-[#fff8e7] from-28% via-[#f7c7e4] via-70% to-[#d4b0ff] sm:bg-[linear-gradient(145deg,var(--tw-gradient-stops))]" x-data="{ showMenu: false }" data-tails-scripts="//unpkg.com/alpinejs">
        @include('rpro.nav')
        <div class="px-4 py-20 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-24">
            <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                <h1 class="max-w-lg mb-6 font-sans text-4xl font-bold leading-none tracking-tight text-gray-900 sm:text-5xl md:mx-auto">
                    {{ __('Register your restaurant') }}
                </h1>
            </div>
        </div>
    </section>

    <div class="flex-1 min-h-screen bg-gray-50">
        <div class="bg-linear-to-t from-gray-100 pb-14 relative">
            <div class="px-4 mx-auto max-w-4xl relative z-10">
                <div class="card bg-white shadow rounded-xl overflow-hidden" style="margin-top: -50px;">
                   
                    <div class="card-body p-6">
                        <form id="{{ getFormId() }}" method="post" action="{{ route('newrestaurant.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-gray-500 font-medium mb-4">{{ __('Restaurant information') }}</h6>

                            @if (session('status'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            
                            <div class="mb-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="name">{{ __('Restaurant Name') }}</label>
                                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500{{ $errors->has('name') ? ' border-red-500' : '' }}" placeholder="{{ __('Restaurant Name here') }} ..." value="{{ isset($_GET["name"])?$_GET['name']:""}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-red-500 text-sm mt-1" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <hr class="my-6 border-gray-200 mb-8" />
                            <h6 class="heading-small text-gray-500 font-medium mb-4">{{ __('Owner information') }}</h6>
                            
                            <div class="mb-6">
                                <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="name_owner">{{ __('Owner Name') }}</label>
                                    <input type="text" name="name_owner" id="name_owner" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500{{ $errors->has('name_owner') ? ' border-red-500' : '' }}" placeholder="{{ __('Owner Name here') }} ..." value="{{ isset($_GET["name"])?$_GET['name']:""}}" required autofocus>

                                    @if ($errors->has('name_owner'))
                                        <span class="text-red-500 text-sm mt-1" role="alert">
                                            <strong>{{ $errors->first('name_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('email_owner') ? ' has-danger' : '' }} mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="email_owner">{{ __('Owner Email') }}</label>
                                    <input type="email" name="email_owner" id="email_owner" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500{{ $errors->has('email_owner') ? ' border-red-500' : '' }}" placeholder="{{ __('Owner Email here') }} ..." value="{{ isset($_GET["email"])?$_GET['email']:""}}" required autofocus>

                                    @if ($errors->has('email_owner'))
                                        <span class="text-red-500 text-sm mt-1" role="alert">
                                            <strong>{{ $errors->first('email_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('phone_owner') ? ' has-danger' : '' }} mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="phone_owner">{{ __('Owner Phone') }}</label>
                                    <input type="text" name="phone_owner" id="phone_owner" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500{{ $errors->has('phone_owner') ? ' border-red-500' : '' }}" placeholder="{{ __('Owner Phone here') }} ..." value="{{ isset($_GET["phone"])?$_GET['phone']:""}}" required autofocus>

                                    @if ($errors->has('phone_owner'))
                                        <span class="text-red-500 text-sm mt-1" role="alert">
                                            <strong>{{ $errors->first('phone_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center mt-8">
                                    @if (strlen(config('settings.recaptcha_site_key'))>2)
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-red-500 text-sm mt-1" role="alert">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif

                                        {!! htmlFormButton(__('Save'), ['id'=>'thesubmitbtn','class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4']) !!}
                                    @else
                                        <button type="submit" id="thesubmitbtn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">{{__('Save')}}</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@if (isset($_GET['name'])&&$errors->isEmpty())
<script>
    "use strict";
    document.getElementById("thesubmitbtn").click();
</script>
@endif
@endsection

<!DOCTYPE html>
<html>
 @include('fusion::templates.head')
<body>

    @include('fusion::templates.mobile-menu')
    <div id='wrapper'>
       
        <div id="embed-webreswidget"></div>
         @include('fusion::templates.header')
         @include('fusion::templates.call_waiter')
        
         @include('fusion::templates.place-content')
         @if (isset($doWeHaveImpressumApp)&&$doWeHaveImpressumApp&&strlen($restorant->getConfig('impressum_value',''))>5)
            @include('fusion::templates.impressum')
        @endif
        <div id="embed-webreswidget"></div>
        @include('fusion::templates.footer')
        @include('fusion::templates.modals')
         
    </div>
   
 
    @include('fusion::templates.scripts')
    
    

        <script>
            var t="<?php echo 'translations.'.App::getLocale() ?>";
           console.log(t);
            window.translations = {!! Cache::get('translations'.App::getLocale(),"[]") !!};
           console.log(window.translations);
           
        </script>

@if(isset($webResWidgetId))
    <script src="{{ url('/popup/webreswidget') }}?id={{ $webResWidgetId }}"></script>
   
@endif
</body>

</html> 
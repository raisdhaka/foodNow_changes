<!DOCTYPE html>
<html>
 @include('minimal::templates.head')
<body>

    @include('minimal::templates.mobile-menu')
    <div id='wrapper'>
       

         @include('minimal::templates.call_waiter')
        
         @include('minimal::templates.place-content')
         @if (isset($doWeHaveImpressumApp)&&$doWeHaveImpressumApp&&strlen($restorant->getConfig('impressum_value',''))>5)
            @include('minimal::templates.impressum')
        @endif

        @include('minimal::templates.footer')
        @include('minimal::templates.modals')
         
    </div>
   
 
    @include('minimal::templates.scripts')
    
    

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
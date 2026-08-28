<!DOCTYPE html>
<html>
 @include('photomenu::templates.head')
<body>

    @include('photomenu::templates.mobile-menu')
    <div id='wrapper'>
       
        <div id="embed-webreswidget"></div>
         @include('photomenu::templates.header')
         @include('photomenu::templates.call_waiter')
        
         @include('photomenu::templates.place-content')
         @if (isset($doWeHaveImpressumApp)&&$doWeHaveImpressumApp&&strlen($restorant->getConfig('impressum_value',''))>5)
            @include('photomenu::templates.impressum')
        @endif
        <div id="embed-webreswidget"></div>
        @include('photomenu::templates.footer')
        @include('photomenu::templates.modals')
         
    </div>
   
 
    @include('photomenu::templates.scripts')
    
    

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
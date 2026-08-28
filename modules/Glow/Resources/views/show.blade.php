<!DOCTYPE html>
<html>
 @include('glow::templates.head')
<body>
    <?php
    try {
        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }
    } catch (\Exception $e) {
    }
    ?>
    @include('glow::templates.mobile-menu')
    <div id='wrapper'>
        <div id="embed-webreswidget"></div>
         @include('glow::templates.header')
         @include('glow::templates.modals')
         @include('glow::templates.call_waiter')
         @include('glow::templates.links')
         @include('glow::templates.place-content')
         @if (isset($doWeHaveImpressumApp)&&$doWeHaveImpressumApp&&strlen($restorant->getConfig('impressum_value',''))>5)
            @include('glow::templates.impressum')
        @endif
        <div id="embed-webreswidget"></div>
        @include('glow::templates.footer')
         
    </div>
   
 
    @include('glow::templates.scripts')
    
    

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
@if (strlen($restorant->getConfig('google_analytics_key',''))>2)
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo config('settings.google_analytics'); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?php echo $restorant->getConfig('google_analytics_key',''); ?>');
    </script>
@endif
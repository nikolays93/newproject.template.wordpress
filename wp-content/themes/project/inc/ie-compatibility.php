<?php

add_filter('wp_head', 'ie_compatibility');

if( !function_exists('ie_compatibility') ) {
    function ie_compatibility() {
    ?>
    <!-- IE compatibility -->
    <!--[if lt IE 9]>
    <script data-skip-moving="true" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script data-skip-moving="true">isIE = true;</script>
    <![endif]-->
    <script data-skip-moving="true">
        var isIE = false /*@cc_on || true @*/;
        if( isIE ) {
            document.createElement( "picture" );
            document.write('<script src="https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/picturefill\/3.0.3\/picturefill.min.js" async><\/script>');
        }

        // if( isIE || /Edge/.test(navigator.userAgent) ) {
        //     document.write(\'<script src="\/assets\/polyfill-svg-uri\/polyfill-svg-uri.min.js" async><\/script>\');
        // }
    </script>
    <?php
    }
}

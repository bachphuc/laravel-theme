<?php
    function __layout(){
        return LaravelTheme::layout();
    }

    function __view($path, $params = [], $package = ''){
        return LaravelTheme::view($path, $params, $package);
    }

    function __view_path($path, $package = ''){
        return LaravelTheme::viewPath($path, $package);
    }
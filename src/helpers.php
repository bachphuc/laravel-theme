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

    function theme_active_menu($menu = ''){
        if(empty($menu)){
            return Theme::getActiveMenu();
        }
        Theme::setActiveMenu($menu);
    }

    function theme_is_active_menu($menu){
        return Theme::isActiveMenu($menu);
    }
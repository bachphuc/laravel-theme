<?php

namespace bachphuc\LaravelTheme\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelThemeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'laravel_theme'; }

    protected static $adminMenus = [];
    protected static $facades = [];

    public static function getAdminMenus(){
        if(!empty(self::$adminMenus)) return self::$adminMenus;

        foreach(self::$facades as $facadeName){
            $facade = resolve($facadeName);
            if($facade && method_exists($facade, 'getAdminMenus')){
                $menus = $facade->getAdminMenus();
                self::addAdminMenu($menus);
            }
        }

        // sort menu by index
        usort(self::$adminMenus, function($a, $b){
            if(!isset($a['position']) && !isset($b['position'])){
                return 0;
            }

            $aPos = isset($a['position']) ? (int) $a['position'] : 1;
            $bPos = isset($b['position']) ? (int) $b['position'] : 1;

        
            return ($aPos < $bPos) ? -1 : 1;
        });

        return self::$adminMenus;
    }

    public static function registerFacade($name){
        self::$facades[] = $name;
    }

    public static function addAdminMenu($menus = []){
        if(empty($menus)) return;

        foreach($menus as $menu){
            self::$adminMenus[] = $menu;
        }
    }
}
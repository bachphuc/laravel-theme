<?php

namespace bachphuc\LaravelTheme;

class Theme
{
    protected $customLayout = null;
    protected $layout = 'default';
    protected $template = 'bootstrap';
    protected $customTemplate = null;
    protected $adminLayout = 'default';
    protected $activeMenu = '';

    public function __construct()
    {   
    }

    public function view($path, $data = [], $package = '')
    {
        return view($this->viewPath($path, $package), $data);        
    }

    public function viewPath($path, $package = '')
    {
        if(strpos($path, '::')){
            $tmp = explode('::', $path);
            $package = $tmp[0];
            $path = $tmp[1];
        }
        
        if(!empty($package)){
            return $package . '::templates.'. $this->getTemplate() . '.' . $path;
        }

        return 'templates.'. $this->getTemplate() . '.' . $path;
    }

    public function adminView($path, $data = [])
    {
        return view($this->adminViewPath($path), $data);        
    }

    public function adminViewPath($path, $package = ''){
        if(!empty($package)){
            return $package . '::admin.'. $this->getTemplate() . '.' . $path;
        }

        return 'admin.'. $this->getTemplate() . '.' . $path;
    }

    public function setLayout($layout)
    {
        $this->customLayout = $layout;
    }

    public function setTemplate($t){
        $this->customTemplate = $t;
    }

    public function getTemplate(){
        if(!empty($this->customTemplate)) return $this->customTemplate;
        if(!empty(config('theme.template'))){
            return config('theme.template');
        }
        return $this->template;
    }

    public function layout($package = '')
    {
        if(!empty($this->customLayout)) return $this->customLayout;

        if(!empty(config('theme.layout'))){
            return config('theme.layout');
        }

        if(!empty($package)){
            return $package . '::templates.' . $this->getTemplate() . '.layouts.' . $this->layout;
        }

        return 'templates.' . $this->getTemplate() . '.layouts.' . $this->layout;
    }

    public function setAdminLayout($layout){
        $this->adminLayout = $layout;
    }

    public function adminLayout(){
        if(function_exists('is_modal_request') && is_modal_request()){
            return 'bachphuc.elements::layouts.blank';
        }
        return 'bachphuc.elements::layouts.admin';
    }
    
    public function setActiveMenu($menu){
        $this->activeMenu = $menu;
    }

    public function getActiveMenu(){
        return $this->activeMenu;
    }

    public function isActiveMenu($menu = ''){
        return $this->activeMenu == $menu;
    }
}
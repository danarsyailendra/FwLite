<?php

namespace lib\MVC\Controller;

abstract class BaseController {
    protected $urlParams;
    protected $action;
    
    public function __construct($action,$urlParams) {
        $this->action = $action;
        $this->urlParams = $urlParams;
    }
    
    public function ExecuteAction() {
        return $this->{$this->action}();
    }
    /**
     * Untuk menampilkan view
     * @param String $viewPath Path untuk View
     * @param Array $data Data yang akan ditampilkan di view
     * @param boolean(optional) $fullView Harus selalu true
     * 
     */
    protected function load($viewPath,$data = array(),$fullView = true) {
        extract($data);
        $content = __DIR__ . "/../../../views/" . $viewPath .".php";
        
        if($fullView){
            require __DIR__ . "/../../../views/template.php";
        } else {
            require $content;
        }
    }
    
}
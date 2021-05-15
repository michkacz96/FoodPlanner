<?php
class Template{
    //path to template
    protected $templatePath;
    
    //additional css paths
    protected $css = array();


    //vars passed in
    protected $vars = array();

    public function __construct($templatePath){
        $this->templatePath = $templatePath;
    }

    public function __get($key){
        return $this->vars[$key];
    }

    public function __set($key, $value){
        $this->vars[$key] = $value;
    }

    public function __toString(){
        extract($this->vars);
        chdir(dirname($this->templatePath));
        ob_start();
        include basename($this->templatePath);

        return ob_get_clean();
    }
}
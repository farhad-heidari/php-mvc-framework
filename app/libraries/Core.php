<?php
    /*
     * App Core Class
     * Creates URL & loads core controller
     * URL FORMAT - /controller/method/params
     */
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());

            $url = $this->getUrl();

            //Find it in controller
            if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
                //if exist, set as controller
                $this->currentController = ucwords($url[0]);
                //Unset it
                unset($url[0]);    
            }
            //Requre the controller
            require_once '../app/controllers/'. $this->currentController .'.php';
            //Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of url
            if(isset($url[1])){
            // Check for existing method in controller
              if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //unset 1 index
                unset($url[1]);  
              } 
            }

            // Get params
            $this->params = $url ? array_values($url) : [] ;

            // call a callback with array of params
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/' , $url);
                return $url;
            }
        }
    }


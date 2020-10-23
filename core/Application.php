<?php

    namespace app\core;
    use app\core\Router;
    use app\core\Request;
    
    /**
     * Class Application
     * @package app\core
     */

    class Application {

        public Router $router;
        public Request $request;
        
        /**
         * __construct
         *
         * @return void
         */
        
        public function __construct()
        {
            $this->request = new Request();
            $this->router = new Router($this->request);
        }
                
        /**
         * run
         *
         * @return void
         */
        
        public function run()
        {
            $this->router->resolve();
        }

    }
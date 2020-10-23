<?php

    namespace app\core;
    use app\core\Request;
    
    /**
     * Class Router
     * @package app\core
     */

    class Router {

        public Request $request;
        protected array $routes = [];
        
        /**
         * __construct
         *
         * @param  app\core\Request $request
         * @return void
         */

        public function __construct(Request $request)
        {
            $this->request = $request;
        }
        
        /**
         * get
         *
         * @param  mixed $path
         * @param  mixed $callback
         * @return void
         */

        public function get($path, $callback)
        {
            $this->routes['get'][$path] = $callback;
        }

        public function resolve()
        {
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path] ?? false;

            if($callback === false) {
                echo '404 ERROR - Not Found!';
                exit;
            }

            echo call_user_func($callback);
        }

    }
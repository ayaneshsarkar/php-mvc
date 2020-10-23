<?php

    namespace app\core;
    use app\core\Router;
    use app\core\Request;
    use app\core\Response;
    
    /**
     * Class Application
     * @package app\core
     */

    class Application {

        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public static Application $app;
                
        /**
         * __construct
         *
         * @param  string $path
         * @return void
         */

        public function __construct(string $path)
        {
            self::$ROOT_DIR = $path;
            self::$app = $this;
            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
        }
        
        public function run()
        {
            echo $this->router->resolve();
        }

    }
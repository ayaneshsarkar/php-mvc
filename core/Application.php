<?php

    namespace app\core;
    use app\core\Router;
    use app\core\Request;
    use app\core\Response;
    use app\controllers\Controller;
    use app\core\Database;

    /**
     * Application class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core
     */
    class Application {

        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public Database $db;
        public static Application $app;
        public Controller $controller;

        /**
         * __construct function
         *
         * @param string $path
         */

        public function __construct(string $path, array $config)
        {
            self::$ROOT_DIR = $path;
            self::$app = $this;
            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);

            $this->db = new Database($config['db']);
        }

        /**
         * Get the value of controller
         * @return $this->controller
         */ 

        public function getController(): Controller
        {
            return $this->controller;
        }

        /**
         * Set the value of controller
         *
         * @return  void
         */ 

        public function setController($controller): void
        {
            $this->controller = $controller;
        }
        
        public function run()
        {
            echo $this->router->resolve();
        }
    }
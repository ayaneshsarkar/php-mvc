<?php

    namespace app\core;
    use app\core\Request;
    use app\core\Application;
    use app\core\Response;
    
    /**
     * Class Router
     * @package app\core
     */

    class Router {

        public Request $request;
        public Response $response;
        protected array $routes = [];
        
        /**
         * __construct
         *
         * @param  app\core\Request $request
         * @param  app\core\Response $response
         * @return void
         */

        public function __construct(Request $request, Response $response)
        {
            $this->request = $request;
            $this->response = $response;
        }
        
        /**
         * get
         *
         * @param  string $path
         * @param  mixed $callback
         * @return void
         */
        
        public function get(string $path, $callback)
        {
            $this->routes['get'][$path] = $callback;
        }
        
        /**
         * post
         *
         * @param  mixed $path
         * @param  mixed $callback
         * @return void
         */
        
        public function post(string $path, $callback)
        {
            $this->routes['post'][$path] = $callback;
        }

        protected function layoutContent()
        {
            ob_start();
            include_once Application::$ROOT_DIR . '/views/layouts/main.php';
            return ob_get_clean();
        }
        
        /**
         * renderOnlyView
         *
         * @param string $view
         * @return void
         */

        protected function renderOnlyView(string $view)
        {
            ob_start();
            include_once Application::$ROOT_DIR . "/views/$view.php";
            return ob_get_clean();
        }
        
        /**
         * renderView
         *
         * @param  string $view
         * @return void
         */

        public function renderView(string $view)
        {
            $layoutContent = $this->layoutContent();
            $viewContent = $this->renderOnlyView($view);
            return str_replace('{{ content }}', $viewContent, $layoutContent);
        }
        
        public function resolve()
        {
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path] ?? false;

            if($callback === false) {
                $this->response->setResponseCode(404);
                return $this->renderView('404');
            }

            if(is_string($callback)) {
                return $this->renderView($callback);
            }

            return call_user_func($callback);
        }

    }
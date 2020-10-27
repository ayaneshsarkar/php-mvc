<?php

    namespace app\core;
    use app\core\Request;
    use app\core\Application;
    use app\core\Response;
    
    /**
     * Router class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core
     */
    class Router {

        public Request $request;
        public Response $response;
        protected array $routes = [];
        
        /**
         * __construct function
         *
         * @param Request $request
         * @param Response $response
         */

        public function __construct(Request $request, Response $response)
        {
            $this->request = $request;
            $this->response = $response;
        }
        
        /**
         * get function
         *
         * @param string $path
         * @param [type] $callback
         * @return void
         */

        public function get(string $path, $callback)
        {
            $this->routes['get'][$path] = $callback;
        }
        
        /**
         * post function
         *
         * @param string $path
         * @param [type] $callback
         * @return void
         */

        public function post(string $path, $callback)
        {
            $this->routes['post'][$path] = $callback;
        }

        protected function layoutContent(array $params)
        {
            foreach($params as $key => $param) {
                $$key = $param;
            }

            ob_start();
            include_once Application::$ROOT_DIR . '/views/layouts/main.php';
            return ob_get_clean();
        }
        
        /**
         * renderOnlyView function
         *
         * @param string $view
         * @return void
         */

        protected function renderOnlyView(string $view, array $params)
        {
            foreach($params as $key => $param) {
                $$key = $param;
            }

            ob_start();
            include_once Application::$ROOT_DIR . "/views/$view.php";
            return ob_get_clean();
        }

        /**
         * renderView function
         *
         * @param string $view
         * @param array $params
         * @return void
         */
        
        public function renderView(string $view, array $params = [])
        {
            $layoutContent = $this->layoutContent($params);
            $viewContent = $this->renderOnlyView($view, $params);
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

            if(is_array($callback)) {
                $callback[0] = new $callback[0]();
            }

            return call_user_func($callback, $this->request);
        }

    }
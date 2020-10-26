<?php

    namespace app\controllers;
    use app\core\Application;

/**
     * Controller class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\controllers
     */
    class Controller {

        /**
         * render function
         *
         * @param string $view
         * @param array $params
         * @return renderView
         */
        public function render(string $view, array $params = [])
        {
            return Application::$app->router->renderView($view, $params);
        }

    }
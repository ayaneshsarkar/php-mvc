<?php

    namespace app\controllers;
    use app\controllers\Controller;
use app\core\Request;

/**
     * AuthController class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\controllers
     */

    class AuthController extends Controller {

        public function login()
        {
            return $this->render('login');
        }
        
        /**
         * register function
         *
         * @param Request $request
         * @return $this->render()
         */
         
        public function register(Request $request)
        {
            $data = [
                'title' => 'Create An Account',
                'name' => 'register'
            ];

            if($request->isPost()) {
                return 'Handle Submitted Data!';
            }

            return $this->render('register', $data);
        }

    }
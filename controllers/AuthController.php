<?php

    namespace app\controllers;
    use app\controllers\Controller;
    use app\core\Request;
    use app\models\RegisterModel;

/**
     * AuthController class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\controllers
     */

    class AuthController extends Controller {

        public function login()
        {
            $data = [
                'title' => 'Login',
                'name' => 'login'
            ];

            $this->setLayout('auth');
            return $this->render('login', $data);
        }
        
        /**
         * register function
         *
         * @param Request $request
         * @return $this->render()
         */
         
        public function register(Request $request)
        {
            $register = new RegisterModel();

            $data = [
                'title' => 'Create An Account',
                'name' => 'register'
            ];

            if($request->isPost()) {
                var_dump($request->getBody());
                exit;
                return 'Handle Submitted Data!';
            }

            $this->setLayout('auth');

            return $this->render('register', $data);
        }

    }
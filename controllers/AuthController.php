<?php

    namespace app\controllers;
    use app\controllers\Controller;
use app\core\Application;
use app\core\Request;
    use app\models\User;

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
            $user = new User();

            $data = [
                'title' => 'Create An Account',
                'name' => 'register',
                'model' => $user
            ];

            if($request->isPost()) {
                $user->loadData($request->getBody());

                if($user->validate() && $user->save()) {
                    Application::$app->response->redirect('/');
                }

                $data['errors'] = $user->errors;

                $this->setLayout('auth');
                return $this->render('register', $data);
            }

            $this->setLayout('auth');
            return $this->render('register', $data);
        }

    }
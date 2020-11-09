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
            $registerModel = new RegisterModel();

            $data = [
                'title' => 'Create An Account',
                'name' => 'register',
                'model' => $registerModel
            ];

            if($request->isPost()) {
                $registerModel->loadData($request->getBody());

                if($registerModel->validate() && $registerModel->register()) {
                    return 'Success';
                }

                $data['errors'] = $registerModel->errors;

                $this->setLayout('auth');
                return $this->render('register', $data);
            }

            $this->setLayout('auth');
            return $this->render('register', $data);
        }

    }
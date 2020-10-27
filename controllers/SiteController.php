<?php

    namespace app\controllers;
    use app\core\Application;
    use app\controllers\Controller;
use app\core\Request;

/**
     * SiteController class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\controllers
     */

    class SiteController extends Controller {

        public function home()
        {
            $data = [
                'title' => 'Welcome!',
                'name' => 'home'
            ];

            return $this->render('welcome', $data);
        }

        public function about()
        {
            $data = [
                'title' => 'About Us',
                'name' => 'about'
            ];
            
            return $this->render('about', $data);
        }

        public function contact()
        {
            $data = [
                'title' => 'Contact Us',
                'name' => 'contact'
            ];
            
            $this->setLayout('auth');

            return $this->render('contact', $data);
        }

        /**
         * storecontact function
         *
         * @param Request $request
         * @return string
         */
        public function storeContact(Request $request)
        {
            $body = $request->getBody();

            echo "<pre>";
            var_dump($body);
            echo "</pre>";
            exit;

            return 'Handle Submit Data!';
        }

    }
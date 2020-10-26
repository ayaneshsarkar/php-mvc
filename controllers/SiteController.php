<?php

    namespace app\controllers;
    use app\core\Application;
    use app\controllers\Controller;

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
            
            return $this->render('contact', $data);
        }

        public function storeContact()
        {
            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            //exit;

            return 'Handle Submit Data!';
        }

    }
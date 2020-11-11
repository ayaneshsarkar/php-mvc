<?php

    namespace app\core;

    /**
     * Response class
     * @package app\core
     */

    class Response {

        public function setResponseCode(int $code) {
            http_response_code($code);
        }

        /**
         * redirect function
         *
         * @param string $url
         * @return void
         */
        public function redirect(string $url)
        {
            header("Location: $url");
        }

    }
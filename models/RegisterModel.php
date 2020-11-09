<?php

    namespace app\models;
    use app\models\Model;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\models
     */

    class RegisterModel extends Model {

        public string $firstname;
        public string $lastname;
        public string $email;
        public string $password;
        public string $confirmPassword;
        
        public function register()
        {
            echo 'Creating New User!';
        }

        public function rules(): array
        {
            return [
                'firstname' => [self::RULE_REQUIRED],
                'lastname' => [self::RULE_REQUIRED],
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 7]],
                'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
            ];
        }

    }


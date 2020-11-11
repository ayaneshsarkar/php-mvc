<?php

    namespace app\models;
    use app\models\Model;
    use app\core\Application;
    use app\core\DBModel;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\models
     */

    class User extends DBModel {

        protected const STATUS_INACTIVE = 0;
        protected const STATUS_ACTIVE = 1;
        protected const STATUS_DELETED = 2;

        public string $firstname = '';
        public string $lastname = '';
        public string $email = '';
        public int $status = self::STATUS_INACTIVE;
        public string $password = '';
        public string $confirmPassword = '';

        public function tableName(): string
        {
            return 'users';
        }
        
        public function save()
        {
            $this->status = self::STATUS_DELETED;
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            return parent::save();
        }

        public function rules(): array
        {
            return [
                'firstname' => [self::RULE_REQUIRED],
                'lastname' => [self::RULE_REQUIRED],
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
                'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 20]],
                'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
            ];
        }

        public function attributes(): array
        {
            return ['firstname', 'lastname', 'email', 'status', 'password'];
        }

    }


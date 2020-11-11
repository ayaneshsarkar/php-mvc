<?php

    namespace app\models;
    use app\core\Application;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\models
     */

    abstract class Model {

        public const RULE_REQUIRED = 'required';
        public const RULE_EMAIL = 'email';
        public const RULE_MIN = 'min';
        public const RULE_MAX = 'max';
        public const RULE_MATCH = 'match';
        public const RULE_UNIQUE = 'unique';

        public function loadData(array $data) 
        {
            foreach($data as $key => $value) {
                if(property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }

        public array $errors = [];

        abstract public function rules(): array;

        public function validate(): bool 
        {
            foreach($this->rules() as $attr => $rules) {
                $value = $this->{$attr};
                
                foreach($rules as $rule) {
                    $ruleName = $rule;

                    if (!is_string($rule)) {
                        $ruleName = $rule[0];
                    }

                    if($ruleName === self::RULE_REQUIRED && !$value) {
                        $this->addError($attr, self::RULE_REQUIRED);
                    }

                    if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addError($attr, self::RULE_EMAIL);
                    }

                    if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                        $this->addError($attr, self::RULE_MIN, $rule);
                    }

                    if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                        $this->addError($attr, self::RULE_MAX, $rule);
                    }

                    if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                        $this->addError($attr, self::RULE_MATCH, $rule);
                    }

                    if($ruleName === self::RULE_UNIQUE) {
                        $className = $rule['class'];
                        $uniqueAttr = $rule['attribute'] ?? $attr;
                        $tableName = $className::tableName();
                        $sql = "SELECT * FROM $tableName WHERE $uniqueAttr = :attr";

                        $statement = Application::$app->db->prepare($sql);
                        $statement->bindValue(":attr", $value);
                        $statement->execute();

                        $record = $statement->fetchObject();

                        if($record) {
                            $this->addError($attr, self::RULE_UNIQUE, ['field' => $attr]);
                        }
                    }
                }
            }

            return empty($this->errors);
        }

        /**
         * addError function
         *
         * @param string $attribute
         * @param string $rule
         * @param array $params
         * @return void
         */
        public function addError(string $attribute, string $rule, array $params = []) 
        {
            $message = $this->errorMessages()[$rule];

            foreach($params as $key => $value) {
                $message = str_replace("{{$key}}", $value, $message);
            }

            $this->errors[$attribute][] = $message;
        }

        public function errorMessages(): array
        {
            return [
                self::RULE_REQUIRED => 'This field is required.',
                self::RULE_EMAIL => 'This field must be a valid email address.',
                self::RULE_MIN => 'Minimum length of this field must be {min}.',
                self::RULE_MAX => 'Maximum length of this field must be {max}.',
                self::RULE_MATCH => 'This field must be the same as {match}.',
                self::RULE_UNIQUE => 'Record with this {field} already exists.'
            ];
        }

        /**
         * hasError function
         *
         * @param string $attribute
         * @return boolean
         */
        public function hasError(string $attribute)
        {
            return $this->errors[$attribute] ?? false;
        }

        /**
         * getFirstError function
         *
         * @param string $attribute
         * @return string
         */
        public function getFirstError(string $attribute): string
        {
           return $this->errors[$attribute][0] ?? '';
        }

    }

<?php

    namespace app\models;

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

        public function validate() {
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
                }
            }
        }

        public function addError(string $attribute, string $rule) {
            
        }

    }

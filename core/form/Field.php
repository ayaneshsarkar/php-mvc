<?php

    namespace app\core\form;
    use app\models\Model;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core\form
     */

    class Field {

        public const TYPE_TEXT = 'text';
        public const TYPE_EMAIL = 'email';
        public const TYPE_PASSWORD = 'password';

        public Model $model;
        public string $attribute;
        public string $label;
        public string $type;

        /**
         * __construct function
         *
         * @param Model $model
         * @param string $attribute
         */
        public function __construct(Model $model, string $attribute, string $label)
        {
            $this->model = $model;
            $this->attribute = $attribute;
            $this->label = $label;
            $this->type = self::TYPE_TEXT;
        }

        /**
         * __toString function
         *
         * @return string
         */
        public function __toString()
        {
            return sprintf('
                <div class="form-group">
                    <label for="%s">%s</label>
                    <input type="%s" name="%s" value="%s" class="form-control%s">
                    <span class="invalid-feedback d-block">%s</span>
                </div>', 

                $this->attribute,
                !empty($this->label) ? $this->label : ucwords($this->attribute),
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                $this->model->getFirstError($this->attribute)
            );
        }

        public function passwordField()
        {
            $this->type = self::TYPE_PASSWORD;
            return $this;
        }

        public function emailField()
        {
            $this->type = self::TYPE_EMAIL;
            return $this;
        }

    }
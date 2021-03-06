<?php

    namespace app\core\form;
    use app\models\Model;
    use app\core\form\Field;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core\form
     */

    class Form {

        /**
         * begin function
         * @param string $action
         * @param string $method
         * @return Form
         */
        public static function begin(string $action, string $method): Form
        {
            echo sprintf('<form action="%s" method="%s">', $action, $method);
            return new Form();
        }

        /**
         * end function
         *
         * @return string
         */
        public static function end(): string
        {
            return '</form>';
        }

        /**
         * field function
         *
         * @param Model $model
         * @param string $attribute
         * @param string $label
         * @return Field
         */
        public function field(Model $model, string $attribute, string $label = ''): Field
        {
            return new Field($model, $attribute, $label);
        }

    }

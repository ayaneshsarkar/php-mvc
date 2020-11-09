<?php

    namespace app\core\form;
    use app\models\Model;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core\form
     */

    class Field {

        public Model $model;
        public string $attribute;

        public function __construct(Model $model, string $attribute)
        {
            $this->model = $model;
            $this->attribute = $attribute;
        }

        public function __toString()
        {
            return sprintf('
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="%s" class="form-control form-control-lg" placeholder="First Name">
                    <span class="invalid-feedback d-block"></span>
                </div>
            ');
        }

    }
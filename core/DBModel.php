<?php

    namespace app\core;
    use app\core\Application;
    use app\models\Model;

    /**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core
     */
    
    abstract class DBModel extends Model {

        public function rules(): array
        {
            return [];
        }

    }
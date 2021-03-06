<?php

    namespace app\core;
    use app\core\Application;
    use app\models\Model;

    /**
     * DBModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core
     */
    
    abstract class DBModel extends Model {

        abstract public function tableName(): string;

        abstract public function attributes(): array;

        public function save()
        {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);

            $statement = self::prepare(
                "INSERT INTO $tableName(". implode(',', $attributes) .") VALUES(".implode(',', $params).");
            ");

            foreach($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();

            return true;
        }

        public static function prepare(string $sql)
        {
            return Application::$app->db->pdo->prepare($sql);
        }

    }
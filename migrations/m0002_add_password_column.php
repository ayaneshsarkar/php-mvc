<?php

    use app\core\Application;

    /**
     * m0002_add_password_column class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\migrations
     */
    class m0002_add_password_column {

        public function up()
        {
            $db = Application::$app->db;
            $SQL = "ALTER TABLE users ADD password VARCHAR(255) NOT NULL";

            $db->pdo->exec($SQL);
        }

        public function down()
        {
            $db = Application::$app->db;
            $SQL = "ALTER TABLE users DROP COLUMN password";

            $db->pdo->exec($SQL);
        }

    }
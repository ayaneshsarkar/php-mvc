<?php

    use app\core\Application;

    /**
     * m0001_initial class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\migrations
     */

    class m0001_initial {

        public function up()
        {
            $db = Application::$app->db;
            $SQL = "CREATE TABLE users(
                id BIGSERIAL PRIMARY KEY NOT NULL,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                status SMALLINT NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            )";

            $db->pdo->exec($SQL);
        }

        public function down()
        {
            $db = Application::$app->db;
            $SQL = "DROP TABLE users";

            $db->pdo->exec($SQL);
        }

    }
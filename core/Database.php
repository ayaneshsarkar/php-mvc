<?php

    namespace app\core;
    use PDO;
    use app\core\Application;

/**
     * RegisterModel class
     * @author Ayanesh Sarkar <ayaneshsarkar101@gmail.com>
     * @package app\core
     */

    class Database {

        public PDO $pdo;

        /**
         * Database Constructor
         * @param array $config
         */
        public function __construct(array $config)
        {
            $dsn = $config['dsn'] ?? '';
            $user = $config['user'] ?? '';
            $password = $config['password'] ?? '';

            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function applyMigrations()
        {
            $this->createMigrationTable();
            $appliedMigrations = $this->getAppliedMigrationsTable();

            $newMIgrtaions = [];

            $files = scandir(Application::$ROOT_DIR . '/migrations');
            $toApplyMigrations = array_diff($files, $appliedMigrations);

            foreach($toApplyMigrations as $migration) {
                if($migration === '.' || $migration === '..') {
                    continue;
                }

                require_once Application::$ROOT_DIR . "/migrations/" . $migration;
                $className = pathinfo($migration, PATHINFO_FILENAME);

                $instance = new $className();
                echo "Applying migration $migration\n";
                $instance->up();
                echo "Applied migration $migration\n";
                
                $newMIgrtaions[] = $migration;
            }

            if(!empty($newMIgrtaions)) {
                $this->saveMigration($newMIgrtaions);
            } else {
                echo "Applied All Migrations!";
            }
        }

        public function createMigrationTable()
        {
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
                id BIGSERIAL PRIMARY KEY NOT NULL,
                migration VARCHAR(255),
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            )");
        }

        public function getAppliedMigrationsTable()
        {
            $statement = $this->pdo->prepare("SELECT migration FROM migrations");
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_COLUMN);
        }

        public function saveMigration(array $migrations)
        {
            // $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            //     ()
            // ");
        }

    }
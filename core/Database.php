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
                $this->log("Applying migration $migration");
                $instance->up();
                $this->log("Applied migration $migration");
                
                $newMIgrtaions[] = $migration;
            }

            if(!empty($newMIgrtaions)) {
                $this->saveMigration($newMIgrtaions);
            } else {
                echo $this->log("Applied All Migrations!");
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

        /**
         * saveMIgration function
         *
         * @param array $migrations
         * @return void
         */
        public function saveMigration(array $migrations)
        {
            $str = implode(',', array_map(fn($m) => "('$m')", $migrations));

            $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");

            $statement->execute();

        }

        /**
         * log function
         *
         * @param string $message
         * @return void
         */
        protected function log(string $message)
        {
            echo '[' . date('Y:-m-d H:i:s') . '] - ' . $message . PHP_EOL;
        }

    }
<?php
    class Database {
        private static $host = "localhost";
        private static $db_name = "dss_tareas_db";
        private static $username = "root";
        private static $password = "";
        private static $conn = null;

        public static function connect() {
            if (self::$conn === null) {
                try {
                    self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$conn->exec("set names utf8mb4");
                } catch (PDOException $e) {
                    die("Error de conexión: " . $e->getMessage());
                }
            }
            return self::$conn;
        }
    }
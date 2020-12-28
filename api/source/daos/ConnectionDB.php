<?php

namespace Source\DAOs;

use PDO;

final class ConnectionDB
{
    private const DB_NAME = "sampledb";
    private const HOST = "localhost";
    private const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    private const PASSWORD = "samplepassword";
    private const USER = "sampleuser";

    private static $instance = null;

    final private function __clone() {}
    final private function __construct() {}
    final private function __wakeup() {}

    final public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME,
                self::USER,
                self::PASSWORD,
                self::OPTIONS
            );

            // Configuring encoding among client and server
            self::$instance->query("SET character_set_client = utf8");
            self::$instance->query("SET character_set_connection = utf8");
            self::$instance->query("SET character_set_results = utf8");
            self::$instance->query("SET character_set_server = utf8");
        }

        return self::$instance;
    }
}
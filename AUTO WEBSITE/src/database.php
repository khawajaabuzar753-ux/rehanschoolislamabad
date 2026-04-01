<?php

declare(strict_types=1);

const DB_HOST = 'localhost';
const DB_NAME = 'abuz_abuzar';
const DB_USER = 'abuz_farhan1';
const DB_PASS = '1234';
const DB_CHARSET = 'utf8mb4';

/**
 * Returns a shared PDO instance.
 */
function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        try {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 5,
            ];

            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log('Database connection error: ' . $e->getMessage());
            throw new Exception('Database connection failed. Please check your database configuration.');
        }
    }

    return $pdo;
}

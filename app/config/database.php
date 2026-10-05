<?php
/**
 * Database Connection & PDO Wrapper
 * 
 * Provides a clean, reusable PDO singleton connection configured with
 * exception mode, utf8mb4 encoding, and prepared statements.
 */

declare(strict_types=1);

namespace App\Config;

use PDO;
use PDOException;
use RuntimeException;

class Database {
    private static ?PDO $connection = null;

    /**
     * Private constructor to prevent direct instantiation.
     */
    private function __construct() {}

    /**
     * Retrieves the shared PDO database connection instance.
     *
     * @return PDO
     * @throws RuntimeException If database connection fails.
     */
    public static function connect(): PDO {
        if (self::$connection === null) {
            $config = config('database');

            if (empty($config['database'])) {
                throw new RuntimeException("Database name is not configured in .env file.");
            }

            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset'] ?? 'utf8mb4'
            );

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . ($config['charset'] ?? 'utf8mb4'),
            ];

            try {
                self::$connection = new PDO($dsn, $config['username'], $config['password'], $options);
            } catch (PDOException $e) {
                if (config('app.debug')) {
                    throw new RuntimeException("Database Connection Error: " . $e->getMessage(), (int)$e->getCode(), $e);
                } else {
                    error_log("Database Connection Error: " . $e->getMessage());
                    throw new RuntimeException("Unable to connect to the database. Please try again later.");
                }
            }
        }

        return self::$connection;
    }

    /**
     * Closes the active database connection.
     *
     * @return void
     */
    public static function disconnect(): void {
        self::$connection = null;
    }

    /**
     * Executes a prepared SQL statement with bound parameters.
     *
     * @param string $sql SQL query with placeholders (:name or ?).
     * @param array $params Values to bind.
     * @return \PDOStatement
     */
    public static function query(string $sql, array $params = []): \PDOStatement {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

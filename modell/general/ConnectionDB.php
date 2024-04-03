<?php
/**
 * Descripcion de ConnectionDB:
 * 
 * @author L.S.C Fernando Garcia Lazaro {
 *  Desarrollador BacKend
 *  Móvil -> (+52) 222-819-4156
 *  Email -> lazaro13251@gmail.com
 * } -> GitHub: https://github.com/lazaro13251/upload-csv
 * 
 * @copyright upload-csv (c) 2023 - 2024
 * 
 */

namespace Modell\General\ConnectionDB;

class ConnectionDB {

    private static $instanceConnection = null;
    private static string $databaseEngine = 'mysql';
    private static string $host = '127.0.0.1';
    private static string $databaseName = 'consultorio-dental';
    private static string $user = 'root';
    private static string $password = '';

    private function __construct() {
        try {
            self::$instanceConnection = new PDO(
                    self::$databaseEngine . ':host=' . self::$host . ';dbname=' . self::$databaseName,
                    self::$user,
                    self::$password
            );
            self::$instanceConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new Exception("Error de conexión a la base de datos: " . $ex->getMessage());
        }
    }

    public static function getInstanceConnection() {
        if (!isset(self::$instanceConnection)) {
            new ConnectionDB();
        }
        return self::$instanceConnection;
    }

    public static function closeConnection(): void {
        self::$instanceConnection = null;
    }

    public static function executeQuery(string $query, array $params = []): PDOStatement {
        $stmt = self::getInstanceConnection()->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}

?>

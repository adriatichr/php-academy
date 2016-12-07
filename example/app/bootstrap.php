<?php

require __DIR__ . '/../vendor/autoload.php';

class Db
{
    private static $connection;

    public static function createConnection()
    {
        $params = self::createDbConnectionParams();
        if(null === self::$connection)
            self::$connection = \Doctrine\DBAL\DriverManager::getConnection([
                'host' => $params->host,
                'driver' => 'pdo_mysql',
                'port' => $params->port,
                'dbname' => $params->db_name,
                'user' => $params->user,
                'password' => $params->password,
            ], new \Doctrine\DBAL\Configuration());

        return self::$connection;
    }

    public static function createDbConnectionParams()
    {
        return json_decode(file_get_contents(__DIR__ . '/mysql_config.json'));
    }

}

<?php

require __DIR__ . '/../vendor/autoload.php';

class Db
{
    private static $pdo;
    private static $dbalConnection;

    public static function createPDO()
    {
        $config = Db::createDbConnectionParams();
        if(null === self::$pdo)
            self::$pdo = new PDO(
                sprintf('mysql:dbname=%s;host=%s;port:%s;charset=UTF8', $config->db_name, $config->host, $config->port),
                $config->user, $config->password,
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);

        return self::$pdo;
    }

    public static function createDoctrineDbalConnection()
    {
        $params = self::createDbConnectionParams();
        if(null === self::$dbalConnection)
            self::$dbalConnection = \Doctrine\DBAL\DriverManager::getConnection([
                'host' => $params->host,
                'driver' => 'pdo_mysql',
                'port' => $params->port,
                'dbname' => $params->db_name,
                'user' => $params->user,
                'password' => $params->password,
            ], new \Doctrine\DBAL\Configuration());

        return self::$dbalConnection;
    }

    private static function createDbConnectionParams()
    {
        return json_decode(file_get_contents(__DIR__ . '/mysql_config.json'));
    }

}

<?php

/**
 * Class Model
 *
 * @package Core
 * @subpackage Model
 *
 * @author phrlog <phrlog@gmail.com>
 *
 */


class Model
{
    /**
     * @var mysqli 
     */
    protected $connection;

    /**
     * Model constructor.
     *
     * Constructor sets up {@link $connection}
     */
    function __construct()
    {
        require_once '../db/db_settings.php';
        try {
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            echo "Connection error.";
        }
        $this->connection->query("SET character_set_results = 'utf8', character_set_client = 'cp1251', character_set_connection = 'cp1251', character_set_database = 'cp1251', character_set_server = 'cp1251'");
        $this->connection->query('set collation_connection="utf8_general_ci"');
    }
    
    
}
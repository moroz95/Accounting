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
        $this->connection = mysqli_connect(
            $db_host,
            $db_username,
            $db_password,
            $db_name);

        mysqli_query($this->connection, "SET character_set_results = 'utf8', character_set_client = 'cp1251', character_set_connection = 'cp1251', character_set_database = 'cp1251', character_set_server = 'cp1251'");
        mysqli_query($this->connection, 'set collation_connection="utf8_general_ci"');
        if (!$this->connection) {
            printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
        }
    }
    
    


}
<?php
    // определяем начальные данные
    $db_host = 'localhost';
    $db_name = 'accounting_performance';
    $db_username = 'root';
    $db_password = 'root';


    // соединяемся с сервером базы данных
    $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
    or die("Не удаётся подключиться к серверу баз данных: " . mysql_error());
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $connect_to_db);

    // подключаемся к базе данных
    mysql_select_db($db_name, $connect_to_db)
    or die("Не удаётся подключиться к базе данных: " . mysql_error());

?>
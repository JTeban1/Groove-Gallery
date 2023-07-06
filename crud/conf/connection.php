<?php

$databaseHost = 'db-mysql-nyc1-29056-do-user-14234655-0.b.db.ondigitalocean.com';
$databaseName = 'gg';
$databaseUsername = 'doadmin';
$databasePassword = 'AVNS_lFvd6MsBVXxnDZ31KyC';
$databasePort = '25060';
//Declaramos datos de conexión


try
{
    $conexion = new PDO("mysql:host=$databaseHost;port=$databasePort;dbname=$databaseName", $databaseUsername, $databasePassword);
        //Estructuramos string de conexión

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e)
{
    echo "La conexión ha fallado: " . $e->getMessage();
}
?>

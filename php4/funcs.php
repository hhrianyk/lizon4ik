<?php
$host = "127.0.0.1";
$dbname = 'anna';
$username = 'root';
$password = 'root';

function query($db, $query)
{
    $result = $db->query($query);
    if (!$result) {
        throw new Exception("Помилка запиту: " . $db->error);
    }
}

function connectToDB($host, $username, $password, $dbname)
{
    try {
        $db = new mysqli($host, $username, $password, $dbname);
        if ($db->connect_error) {
            throw new Exception("Помилка підключення: " . $db->connect_error);
        }
        // $db->set_charset("utf-8");
        return $db;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

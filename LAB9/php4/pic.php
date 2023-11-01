<?php
include_once("funcs.php");
header('Content-type: image/*');
if (isset($_GET['id'])) {
    $db = connectToDB($host, $username, $password, $dbname);
    $sql = "select picture from tab1 where id='" . (int)$_GET['id'] . "'";
    $result = $db->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        echo $row['picture'];
    }
}

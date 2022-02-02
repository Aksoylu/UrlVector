<?php
/*
*   Author:  Umit Aksoylu
*   Date:    31.12.2020
*   Project: Proton Framework
*   Description: Database Module of Proton Framework. Requires multiple DB implementation
*/
require_once "Proton/core.php";

try {

    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASS,
    array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));

} catch ( PDOException $e ){
    print $e->getMessage();
    PROTON::RENDER("_error", ["reason"=>"Database Error;<br><p>".$e->getMessage()."</p"], $flag = true);
    exit();
}


?>
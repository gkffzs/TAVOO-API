<?php 
    $username = "root"; 
    $password = "tav110xx0B"; 
    $host = "127.0.0.1"; 
    $dbname = "tavoo_db"; 

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8;');
     
    try {  
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    } catch(PDOException $ex) { 
        die("Connection to database failed: " . $ex->getMessage()); 
    } 
    
    header('Content-Type: text/html; charset=utf-8'); 
    
    session_start(); 
?>
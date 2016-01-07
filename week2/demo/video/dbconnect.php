<?php

function dbconnect() {
    $config = array(
        'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=PHPClassSummer2015',
        'DB_USER' => 'php',
        'DB_PASSWORD' => 'summer15'
    );

    try {

        $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
    
    return $db;    
}

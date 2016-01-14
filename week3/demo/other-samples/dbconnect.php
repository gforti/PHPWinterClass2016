<?php
/**
 * Function to extablish a databse connection
 * 
 * @return PDO Object
 */  
function getDatabase() {
    $config = array(
        'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=PHPClassWinter2016',
        'DB_USER' => 'php',
        'DB_PASSWORD' => 'winter16'
    );

    try {
        /* Create a Database connection and 
         * save it into the variable */
        $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $ex) {
        /* If the connection fails we will close the 
         * connection by setting the variable to null */
        $db = null;
    }

    return $db;
}




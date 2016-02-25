<?php
/*
 * products
 * product_id
 * category_id
 * product
 * price
 * image
 */


function createProduct($category_id, $product, $price, $image ) {
    
    $db = dbconnect();
    $stmt = $db->prepare("INSERT INTO products SET category_id = :category_id, product = :product, price = :price, image = :image ");

    $binds = array(
        ":category_id" => $category_id,
        ":product" => $product,
        ":price" => $price,
        ":image" => $image
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        return true;
    }
     
    return false;
    
    
}


function getAllProducts() {
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM products JOIN categories WHERE categories.category_id = products.category_id");
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
    return $results;
    
}



function getProduct($id) {
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM products JOIN categories WHERE categories.category_id = products.category_id AND product_id = :product_id");
     $binds = array(
        ":product_id" => $id
    );
    
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }
     
    return $results;
    
}



function isValidProduct($value) {
    if ( empty($value) ) {
        return false;
    }
    return true;    
}
function isValidPrice($value) {
    if ( empty($value) ) {
        return false;
    }
    return true;
}


function uploadImage($fieldName){
    
    /* make sure path to upload images matches where you want to upload it */
    $folderLocation = '../../images/';
    
    if ( !is_string($fieldName) || empty($fieldName) ) {
        throw new RuntimeException('Field Name must be a string.');
    }
       
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if ( !isset($_FILES[$fieldName]['error']) || is_array($_FILES[$fieldName]['error']) ) {       
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES[$fieldName]['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }
     
    // You should also check filesize here. 
    if ($_FILES[$fieldName]['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $validExts = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                );    
    $ext = array_search( $finfo->file($_FILES[$fieldName]['tmp_name']), $validExts, true );
    
    
    if ( false === $ext ) {
        throw new RuntimeException('Invalid file format.');
    }
    
     /* Alternative to getting file extention 
    $name = $_FILES["upfile"]["name"];
    $ext = strtolower(end((explode(".", $name))));
    if (preg_match("/^(jpeg|jpg|png|gif)$/", $ext) == false) {
        throw new RuntimeException('Invalid file format.');
    }
     Alternative END */

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    
    $fileName =  sha1_file($_FILES[$fieldName]['tmp_name']); 
    $location = sprintf($folderLocation.'%s.%s', $fileName, $ext); 
    
    if (!is_dir($folderLocation)) {
        mkdir($folderLocation);
    }
        
    if ( !move_uploaded_file( $_FILES[$fieldName]['tmp_name'], $location) ) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    /* return the file name uploaded */
    return $fileName.'.'.$ext;
}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php
        
            require_once '../includes/session-start.req-inc.php';
            
            include_once '../functions/dbconnect.php';
            include_once '../functions/login-function.php';
            include_once '../functions/utils-function.php';
        
            if ( isPostRequest() ) {
                
                $email = filter_input(INPUT_POST, 'email');
                $password = filter_input(INPUT_POST, 'pass');
                
                if ( isValidUser($email, $password) ) {
                    $_SESSION['isValidUser'] = true;                    
                } else {
                    $results = 'Sorry please try again';
                }
               
            }
            
            
            if ( isset($_SESSION['isValidUser']) &&  $_SESSION['isValidUser'] === true ) {
                include '../includes/admin-links.html.php';
            }
            
        ?>
        
        <?php include '../includes/results.html.php'; ?>
        
        <?php include '../includes/loginform.html.php'; ?>
    </body>
</html>

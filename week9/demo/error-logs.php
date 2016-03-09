<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include './error-log-function.php';
            
            
            try {
                
                if ( $badVariable ) {
                    
                }                
                
            } catch (ErrorException $ex) {

                logError($ex->getMessage());
            }
            
            
            
            logError('Could not connect to the database.');
        ?>
    </body>
</html>

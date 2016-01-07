<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            /*
             * Some functions to learn.  Learn more about them on PHP.net
             * 
             * strtoupper
             * var_dump
             * isset
             */
            $str = 'hello';            
            echo strtoupper($str);
        
            $randColor = '#'.strtoupper(dechex(rand(0x000000, 0xFFFFFF)));

            echo $randColor;    
            
            var_dump($randColor);
            
            if ( isset($randColor) ) {
                
            }
            
        ?>
    </body>
</html>

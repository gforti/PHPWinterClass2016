<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once '../includes/session-start.req-inc.php';
            require_once '../functions/cart-functions.php';
            require_once '../functions/dbconnect.php';
            require_once '../functions/until.php';
            require_once '../functions/category-functions.php';
            require_once '../functions/products-functions.php';
                        
            startCart(); 
                
            $total = 0;
            
            $checkoutProducts = array();
            
            $items = getCart();
            
            print_r($items);
            
            foreach ($items as $id) {
                $checkoutProducts[] = getProduct($id);
            }
            
            
            include '../includes/checkout.html.php';
        ?>
    </body>
</html>

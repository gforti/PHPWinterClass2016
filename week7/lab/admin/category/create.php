<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        require_once '../../includes/session-start.req-inc.php';
         require_once '../../includes/access-required.html.php';
         
         
        include_once '../../functions/dbconnect.php';
        include_once '../../functions/category-functions.php';
        include_once '../../functions/until.php';
        
       
        
        if ( isPostRequest() ) {
            
            $category = filter_input(INPUT_POST, 'category');
                                    
            if ( isValidCategory($category) ) {
                
                if ( createCategory($category) ) {
                    $results = 'Category added';
                } else {
                    $results = 'Category was not added';
                }
                               
            } else {
               $results = 'Category is not valid';
            }
            
            
        }
        
        
        ?>
        
         <h1>Add Category</h1>
        
       <?php include '../../includes/results.html.php'; ?>
               
        <form method="post" action="#">
            Category Name : <input type="text" name="category" value="" />
            <input type="submit" value="Submit" />
        </form>
        
        
    </body>
</html>

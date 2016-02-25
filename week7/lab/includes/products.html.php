

<?php if ( isset($allProducts) && count($allProducts) > 0 ) : ?>

<table>

    <?php foreach ($allProducts as $row): ?>
        <tr>
            <td>
                <?php if ( empty($row['image']) ) : ?>
                    No Image
                <?php else: ?>
                    <img src="../images/<?php echo $row['image']; ?>" width="100" height="100" />
                <?php endif; ?>
            </td>
            <td><?php echo $row['product']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <form method="post" action="#">
                    <input type="submit" value="Buy" />
                    <input type="hidden" name="action" value="buy" />
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                </form>
            </td>
            
        </tr>    
    <?php endforeach; ?>   

</table>
 <?php else: ?>       
        <h2>No Products Found</h2>
<?php endif; ?>

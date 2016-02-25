<?php



function startCart() {
    if ( !isset($_SESSION['cart']) ) {
       emptyCart();
    }   
}

function emptyCart() {
    $_SESSION['cart'] = array();
}

function addToCart($id) {        
     $_SESSION['cart'][] = $id;
}

function getCart() {
    return $_SESSION['cart'];
}

function getCartCount() {
    return count($_SESSION['cart']);
}



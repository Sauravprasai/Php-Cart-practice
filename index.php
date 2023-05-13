<?php
require_once('cart.php');

// Start session management with a persistent cookie
$lifetime1 = 60 * 60 * 24 *  1095;    // session for 3 years
session_set_cookie_params($lifetime1, '/');

session_start();

// Create a cart array if needed
if (empty($_SESSION['cart'])) { $_SESSION['cart'] = []; }

// Create a table of products
$products = [
    'MMS-1754' => ['name' => 'Flute', 'cost' => '149.50'],
    'MMS-6289' => ['name' => 'Trumpet', 'cost' => '199.50'],
    'MMS-3408' => ['name' => 'Clarinet', 'cost' => '299.50'],
    'MMS-5167' => ['name' => 'Harmonia', 'cost' => '100.00'],
    'MMS-8213' => ['name' => 'Banjo', 'cost' => '150.00'],
];

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed
switch($action) {
    case 'add':
        $product_key = filter_input(INPUT_POST, 'productkey');
        $item_qty = filter_input(INPUT_POST, 'itemqty', FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>5)));
        $warranty = filter_input(INPUT_POST, 'warranty');
        $customer_name = filter_input(INPUT_POST, 'customer_name');
        if($item_qty !== FALSE) {
            $product = $products[$product_key];
            add_item($product_key, $item_qty, $product, $warranty, $customer_name);  
            header('Location: .?action=show_cart');
        } else {
            $error_msg = "Quantity must be between 1 and 5.";
            include('add_item_view.php');
        }        
        break;
    
    case 'update':
        $new_qty_list = filter_input(INPUT_POST, 'newqty', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach($new_qty_list as $key => $qty) {
            if ($qty < 1) {
                $qty = 1;
            }
            elseif ($qty > 5) {
                $qty = 5;}

            if ($_SESSION['cart12'][$key]['qty'] != $qty) {
                update_item($key, $qty);
            }
        }
        header('Location: .?action=show_cart');
        break;

    case 'show_cart':
        include('cart_view.php');
        break;
    case 'show_add_item':
        include('add_item_view.php');
        break;

    case 'empty_cart':
        $confirmation = "Are you sure you want to empty your cart?";
        include('confirm_empty_cart_view.php');
        break;
        
    case 'confirm_empty_cart':
        $confirm = filter_input(INPUT_POST, 'confirm');
        if ($confirm === 'Yes') {
            unset($_SESSION['cart12']);
            include('cart_view.php');
        }
        header('Location: .?action=show_cart');
        break;
        
	case 'session_delete':
        unset($_SESSION['cart12']);
		session_regenerate_id();
		session_destroy();
        include('cart_view.php');
        break;
}
?>
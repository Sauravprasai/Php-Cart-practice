<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <h1>My Guitar Shop</h1>
    </header>
    <main>

        <h1>Add Item</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="add">
            <label>Customer Name:</label>
            <input type="text" name="customer_name"><br>

            <label>Name:</label>
            <select name="productkey">
            <?php foreach($products as $key => $product) :
                $cost = number_format($product['cost'], 2);
                $name = $product['name'];
                $item = $name . ' ($' . $cost . ')';
            ?>
                <option value="<?php echo $key; ?>">
                    <?php echo $item; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Quantity:</label>
            <select name="itemqty">
            <?php for($i = 1; $i <= 10; $i++) : ?>
                <option value="<?php echo $i; ?>">
                    <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        
            </select><br>

            <label>Warranty Period:</label>
            <input type="radio" name="warranty" value="3" id="warranty3" checked="checked">
            <label for="warranty3">3 years($100)</label>
            <input type="radio" name="warranty" value="5" id="warranty5">
            <label for="warranty5">5 years($200)</label>
            <input type="radio" name="warranty" value="7" id="warranty7">
            <label for="warranty7">7 years($300)</label>
            
            <br>

            

            <label>&nbsp;</label>
            <input type="submit" value="Add Item"/>
        </form>
        <p><a href=".?action=show_cart">View Cart</a></p>

    </main>
</body>

</html>
<?php
echo "<h1>Session ID:".session_id()."</h1>";
?>
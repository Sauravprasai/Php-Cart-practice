<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Empty Cart</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h1>Confirming Empty Cart</h1>
    <p><?php echo $confirmation; ?></p>
    <form method="post" action = ".">
        <input type="hidden" name="action" value="confirm_empty_cart">
        <input type="submit" value="Yes" name="confirm">
        <input type="submit" value="No" name="confirm">
    </form>
</body>
</html>

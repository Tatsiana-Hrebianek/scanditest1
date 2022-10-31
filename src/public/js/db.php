<?php
$inp = $_POST['sku'];
$dbConnection = mysqli_connect('db', 'root', 'root', 'scandi');
mysqli_query($dbConnection, "SET NAMES 'utf8'");
$query = "SELECT * FROM products";
$result = mysqli_query($dbConnection, $query) or die(mysqli_error($dbConnection));
$row = mysqli_fetch_assoc($result);
if (!empty($inp)) {
    if ($inp === $row['sku']) {
        echo 'This sku already exists in db';
    }
} else {
    echo 'Please, insert SKU!';
}

?>


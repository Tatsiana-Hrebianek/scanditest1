<?php header('Content-Type: application/json');
$inp = $_POST['param'];
$value = $_POST[$inp];
$error = $_POST['error'];
$dbConnection = new PDO("mysql:host=db;dbname=scandi", 'root', 'root');
$dbConnection->query("SET NAMES 'utf8'");
$query = "SELECT * FROM products";
$sth = $dbConnection->prepare($query);
$sth->execute();
$row = $sth->fetch();

if (!empty($value)) {

    if ($value === $row["$inp"]) {
        $mes = ['error1' => "$error"];
        echo json_encode($mes);
    } else {
        $mes = ['error1' => "ok"];
        echo json_encode($mes);
    }
} else {
    $mes = ['error1' => "Please enter $inp!"];
    echo json_encode($mes);
}
?>


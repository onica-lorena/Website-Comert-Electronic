<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (!$user_data) {
    header("Location: login.php");
    die;
}

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $user_id = $user_data['user_id'];

    $query = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
    } else {
        $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)";
    }

    mysqli_query($con, $query);
    header("Location: cos.php");
    die;
}

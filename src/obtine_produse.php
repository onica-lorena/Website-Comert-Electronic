<?php
include("connection.php");

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'toate';

$searchTerm = mysqli_real_escape_string($con, $searchTerm);
$selectedCategory = mysqli_real_escape_string($con, $selectedCategory);

$query = "SELECT * FROM products WHERE name LIKE '%$searchTerm%'";
if ($selectedCategory != 'toate') {
    $query .= " AND category = '$selectedCategory'";
}

$result = mysqli_query($con, $query);

$produse = [];
while ($product = mysqli_fetch_assoc($result)) {
    $produse[] = $product;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($produse);

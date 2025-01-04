<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dynamic_content_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

$sql = "SELECT id, name, age, email FROM entries";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <title>Intrări dinamic</title>
</head>

<body>
    <h1>Lista de intrări</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Vârstă</th>
            <th>Email</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['email']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nu există date</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
$conn->close();
?>
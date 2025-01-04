<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "import";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

$sql = "SELECT name, age, email FROM entries";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Afișare Entries</title>
    <link rel="stylesheet" href="style5.css" />
</head>

<body>

    <h2>Entries</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["age"] . "</td><td>" . $row["email"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>0 results</td></tr>";
        }
        $conn->close();
        ?>
    </table>

</body>

</html>
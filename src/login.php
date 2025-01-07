<?php
session_start();
include("connection.php");
include("functions.php");

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            } else {
                $error_message = "Parola este incorectă!";
            }
        } else {
            $error_message = "Contul nu există! <a href='signup.php'>Creează un cont</a>";
        }
    } else {
        $error_message = "Introduceți informații valide!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Conectare</title>
    <link rel="stylesheet" href="styles/style2.css" />
</head>

<body>
    <style type="text/css">
        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button {
            padding: 8px;
            width: 100px;
            color: white;
            background-color: lightcoral;
            border: none;
        }

        #box {
            background-color: beige;
            margin: auto;
            width: 300px;
            padding: 20px;
        }

        #error_message {
            color: red;
        }
    </style>
    <header>
        <img src="images/logo.png" alt="Logo" />
        <ul class="menu">
            <li><a href="index.html">Acasă</a></li>
            <li class="dropdown">
                <a href="produse.php">Produse</a>
            </li>
            <li><a href="about.html">Despre</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <ul class="menu">
            <li class="dropdown">
                <a class="icons" id="user" href="index.php">
                    <img src="images/user.png" alt="user" /><span>Cont</span>
                </a>
                <ul class="dropdown-content">
                    <li>
                        <a href="login.php">Conectează-te</a>
                    </li>
                    <li>
                        <a href="signup.php">Înregistrează-te</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="icons" id="bag" href="cos.php">
                    <img src="images/shopping-bag.png" alt="shop-bag" /><span>Coş</span>
                </a>
            </li>
        </ul>
    </header>
    <div id="box">
        <form method="post">
            <div style="font-size: 20px; margin: 10px; color: black">Conectează-te</div>
            <?php if (!empty($error_message)) : ?>
                <div id="error_message"><?php echo $error_message; ?></div><br>
            <?php endif; ?>
            <input id="text" type="text" name="user_name"><br><br>
            <input id="text" type="password" name="password"><br><br>
            <input id="button" type="submit" value="Conectează-te"><br><br>
            <a href="signup.php">Înregistrează-te</a><br><br>
        </form>
    </div>
</body>

</html>

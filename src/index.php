<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cont</title>
    <link rel="stylesheet" href="styles/style2.css" />

</head>

<body>
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
        <form action="search.php" method="GET" class="search-bar">
            <input type="text" name="query" placeholder="Căutare...">
            <button type="submit">Caută</button>
        </form>
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
    <?php if ($user_data) : ?>
        <script type="text/javascript">
            var userName = <?php echo json_encode($user_data['user_name']); ?>;
        </script>
        <button class="button connect-button"><a class="connect" href="logout.php">DECONECTEAZĂ-TE</a></button>
        <br>
        <div id="user-message"></div>
    <?php else : ?>
        <div class="container">
            <p>Ai deja un cont?</p>
            <button class="button connect-button"><a class="connect" href="login.php">CONECTEAZĂ-TE</a></button>
            <p>Este prima ta vizită pe site-ul nostru?</p>
            <button class="button register-button"><a class="register" href="signup.php">ÎNREGISTREAZĂ-TE</a></button>
        </div>
    <?php endif; ?>
    <script type="text/javascript">
        if (typeof userName !== 'undefined') {
            document.getElementById('user-message').innerText = 'Hello, ' + userName + '!';
        }
    </script>
</body>

</html>

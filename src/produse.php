<?php
session_start();
include("connection.php");
include("functions.php");

$query = "SELECT * FROM products";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse pentru Femei</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="produse.js"></script>
    <link rel="stylesheet" href="styles/style2.css">
</head>

<body>
    <header>
        <img src="images/logo.png" alt="Logo">
        <ul class="menu">
            <li><a href="index.html">Acasă</a></li>
            <li class="dropdown"><a href="produse.php">Produse</a></li>
            <li><a href="about.html">Despre</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <form action="search.php" method="GET" class="search-bar">
            <input type=" text" name="query" placeholder="Căutare...">
            <button type="submit">Caută</button>
        </form>
        <ul class="menu">
            <li class="dropdown">
                <a class="icons" id="user" href="index.php">
                    <img src="images/user.png" alt="user"><span>Cont</span>
                </a>
                <ul class="dropdown-content">
                    <li><a href="login.php">Conectează-te</a></li>
                    <li><a href="signup.php">Înregistrează-te</a></li>
                </ul>
            </li>
            <li>
                <a class="icons" id="bag" href="cos.php">
                    <img src="images/shopping-bag.png" alt="shop-bag"><span>Coş</span>
                </a>
            </li>
        </ul>
    </header>
    <main>
        <h1>Produse pentru Femei</h1>
        <form method="POST" action="filter.php" class="filter">
            <label for="category">Categorie:</label>
            <select id="category" name="category" onchange="this.form.submit()">
                <option value="toate" <?php echo isset($_POST['category']) && $_POST['category'] == 'toate' ? 'selected' : ''; ?>>Toate</option>
                <option value="haine" <?php echo isset($_POST['category']) && $_POST['category'] == 'haine' ? 'selected' : ''; ?>>Haine</option>
                <option value="incaltaminte" <?php echo isset($_POST['category']) && $_POST['category'] == 'incaltaminte' ? 'selected' : ''; ?>>Încălțăminte</option>
                <option value="accesorii" <?php echo isset($_POST['category']) && $_POST['category'] == 'accesorii' ? 'selected' : ''; ?>>Accesorii</option>
            </select>
        </form>
        <div id="product-list" class="product-list">
            <?php while ($product = mysqli_fetch_assoc($result)) : ?>
                <div class="product">
                    <img src="images/<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image2">

                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo $product['price']; ?> lei</p>
                    <button onclick="location.href='adauga_in_cos.php?id=<?php echo $product['product_id']; ?>'">Adaugă în coș</button>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
    <footer>
        <p>Urmăreşte-ne pe</p>
        <ul class="menu2">
            <li><a class="icons"><img src="images/facebook.png" alt="Facebook"></a></li>
            <li><a class="icons"><img src="images/instagram.png" alt="Instagram"></a></li>
            <li><a class="icons"><img src="images/tiktok.png" alt="TikTok"></a></li>
            <li><a class="icons"><img src="images/youtube.png" alt="YouTube"></a></li>
            <li><a class="icons"><img src="images/pinterest.png" alt="Pinterest"></a></li>
        </ul>
    </footer>
</body>

</html>

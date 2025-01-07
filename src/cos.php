<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (!$user_data) {
    header("Location: login.php");
    die;
}

$user_id = $user_data['user_id'];
$query = "SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.product_id WHERE cart.user_id = '$user_id'";
$result = mysqli_query($con, $query);

$total_sum = 0;
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coșul meu</title>
    <link rel="stylesheet" href="styles/style2.css">
    <link rel="stylesheet" href="styles/style4.css" />
    <script src="produse.js"></script>
    <script>
        function updateCart(product_id) {
            const quantity = document.querySelector(`#quantity-${product_id}`).value;
            fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `product_id=${product_id}&quantity=${quantity}`
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cantitatea a fost actualizată.');
                        updateTotalSum();
                    } else {
                        alert('A apărut o problemă. Încercați din nou.');
                    }
                });
        }

        function deleteFromCart(product_id) {
            fetch('delete_from_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `product_id=${product_id}`
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`#item-${product_id}`).remove();
                        alert('Produsul a fost șters.');
                        updateTotalSum();
                    } else {
                        alert('A apărut o problemă. Încercați din nou.');
                    }
                });
        }

        function updateTotalSum() {
            let totalSum = 0;
            document.querySelectorAll('#cos li').forEach(item => {
                const price = parseFloat(item.dataset.price);
                const quantity = parseInt(item.querySelector('input[type="number"]').value);
                totalSum += price * quantity;
            });
            document.querySelector('#total-sum').innerText = 'Total: ' + totalSum.toFixed(2) + ' lei';
        }
    </script>
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
        <h1>Coșul meu</h1>
        <ul id="cos">
            <?php while ($item = mysqli_fetch_assoc($result)) : ?>
                <li id="item-<?php echo $item['product_id']; ?>" data-price="<?php echo $item['price']; ?>">
                    <?php echo htmlspecialchars($item['name']); ?> - <?php echo $item['price']; ?> lei
                    <input type="number" id="quantity-<?php echo $item['product_id']; ?>" value="<?php echo $item['quantity']; ?>" min="1">
                    <button class="delete-button" onclick="updateCart(<?php echo $item['product_id']; ?>)">Actualizează</button>
                    <button class="delete-button" onclick="deleteFromCart(<?php echo $item['product_id']; ?>)">Șterge</button>
                </li>
                <?php $total_sum += $item['price'] * $item['quantity']; ?>
            <?php endwhile; ?>
        </ul>
        <p id="total-sum">Total: <?php echo number_format($total_sum, 2); ?> lei</p>

        <div id="container">
            <div id="movableDiv">
                <h1><a class="connect" href="promo.html">SUNNY DEALS -15%</a></h1>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                function updateFooterPosition() {
                    const movableDiv = $("#movableDiv");
                    const footer = $("footer");
                    const divBottom = movableDiv.offset().top + movableDiv.outerHeight();
                    footer.css('top', divBottom + 20);
                }

                updateFooterPosition();

                $("#moveUp").click(function() {
                    $("#movableDiv").animate({
                        top: "-=250px"
                    }, "slow", updateFooterPosition);
                });
                $("#moveDown").click(function() {
                    $("#movableDiv").animate({
                        top: "+=250px"
                    }, "slow", updateFooterPosition);
                });
                $("#moveLeft").click(function() {
                    $("#movableDiv").animate({
                        left: "-=250px"
                    }, "slow", updateFooterPosition);
                });
                $("#moveRight").click(function() {
                    $("#movableDiv").animate({
                        left: "+=250px"
                    }, "slow", updateFooterPosition);
                });

                $("#fadeIn").click(function() {
                    $("#movableDiv").fadeIn("slow", updateFooterPosition);
                });

                $("#fadeOut").click(function() {
                    $("#movableDiv").fadeOut("slow", updateFooterPosition);
                });

                $("#zoomIn").click(function() {
                    $("#movableDiv").animate({
                        width: "+=10px",
                        height: "+=10px"
                    }, "slow", updateFooterPosition);
                });
                $("#zoomOut").click(function() {
                    $("#movableDiv").animate({
                        width: "-=10px",
                        height: "-=10px"
                    }, "slow", updateFooterPosition);
                });

                $(document).keydown(function(e) {
                    switch (e.key) {
                        case 'ArrowUp':
                            $("#movableDiv").animate({
                                top: "-=250px"
                            }, "slow", updateFooterPosition);
                            break;
                        case 'ArrowDown':
                            $("#movableDiv").animate({
                                top: "+=250px"
                            }, "slow", updateFooterPosition);
                            break;
                        case 'ArrowLeft':
                            $("#movableDiv").animate({
                                left: "-=250px"
                            }, "slow", updateFooterPosition);
                            break;
                        case 'ArrowRight':
                            $("#movableDiv").animate({
                                left: "+=250px"
                            }, "slow", updateFooterPosition);
                            break;
                        case '+':
                            $("#movableDiv").animate({
                                width: "+=10px",
                                height: "+=10px"
                            }, "slow", updateFooterPosition);
                            break;
                        case '-':
                            $("#movableDiv").animate({
                                width: "-=10px",
                                height: "-=10px"
                            }, "slow", updateFooterPosition);
                            break;
                        case 'f':
                            $("#movableDiv").fadeIn("slow", updateFooterPosition);
                            break;
                        case 'h':
                            $("#movableDiv").fadeOut("slow", updateFooterPosition);
                            break;
                    }
                });
            });
        </script>
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

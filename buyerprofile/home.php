<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Buyer Profile</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../images/logo.png" alt="Logo" />
        </div>
        <div class="welcome">
            <?php
            session_start();
            if (isset($_SESSION['user_name'])) {
                echo "Hello, " . $_SESSION['user_name'] . "!";
            } else {
                echo "Hello, Guest!";
            }
            ?>
        </div>
        <div class="dropdown">
            <button class="dropbtn">settings</button>
            <div class="dropdown-content">
                <?php
                if (isset($_SESSION['user_name'])) {
                    // User is logged in
                    echo '<a href="#">profile</a>';
                    echo '<a href="#">transaction</a>';
                    echo '<a href="farmers.php">farmers</a>';
                    echo '<a href="#">log out</a>';
                } else {
                    // User is not logged in
                    echo '<a href="../login.php">log in</a>';
                }
                ?>
            </div>
        </div>
        <a href="cartpage.php">Cart Product</a>

    </header>
    <main>
        <div class="search-container">
            <form action="search_results.php" method="GET">
                <input type="text" name="search_query" placeholder="Search for products..." />
                <button type="submit">Search</button>
            </form>
        </div>
    </main>
    <footer>
        <!-- Footer content here -->
    </footer>
</body>

</html>
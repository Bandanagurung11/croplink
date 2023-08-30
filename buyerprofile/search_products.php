<?php
// Simulated product data
$products = array(
    array('name' => 'Apples', 'price' => 2.50),
    array('name' => 'Oranges', 'price' => 1.75),
    array('name' => 'Carrots', 'price' => 0.80)
);

// Process search query
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $searchResults = array_filter($products, function ($product) use ($searchQuery) {
        return strpos(strtolower($product['name']), strtolower($searchQuery)) !== false;
    });
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
</head>

<body>
    <h1>Search Results</h1>
    <?php if (isset($searchResults)) { ?>
        <?php if (empty($searchResults)) { ?>
            <p>No results found.</p>
        <?php } else { ?>
            <ul>
                <?php foreach ($searchResults as $product) { ?>
                    <li><?php echo $product['name']; ?> - $<?php echo $product['price']; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <a href="buyer_profile.html">Back to Profile</a>
    <?php } else { ?>
        <p>No search query provided.</p>
    <?php } ?>
</body>

</html>
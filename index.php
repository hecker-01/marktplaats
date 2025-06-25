<?php
// Homepage: Displays all luxury products grouped by category
include 'includes/header.php';
include 'includes/db_connection.php';

// Fetch products grouped by category
$query = "SELECT * FROM products ORDER BY category";
$result = $db->query($query);

$categories = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $categories[$row['category']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wealth Creators - Luxury Marketplace</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main>
        <h1>Welcome to Wealth Creators</h1>
        <p>Browse our exclusive collection of luxury items.</p>

        <?php foreach ($categories as $category => $products): ?>
            <section>
                <h2><?php echo htmlspecialchars($category); ?></h2>
                <div class="product-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                            <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>">View Details</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

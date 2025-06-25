<?php
// Product showcase page
include 'includes/header.php';
include 'includes/db_connection.php';

$product_id = $_GET['id'] ?? null;
if (!$product_id) {
    echo "<p>Product not found.</p>";
    exit;
}

$query = "SELECT * FROM products WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindValue(':id', $product_id, SQLITE3_INTEGER);
$result = $stmt->execute();
$product = $result->fetchArray(SQLITE3_ASSOC);

if (!$product) {
    echo "<p>Product not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Wealth Creators</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Inline CSS for enhanced styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        main {
            padding: 2em;
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            font-size: 2.5em;
            color: #222;
        }

        img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 1em;
        }

        form {
            background: #fff;
            padding: 1.5em;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
        }

        form input, form textarea, form button {
            width: 100%;
            margin-bottom: 1em;
            padding: 0.75em;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>

        <form action="place_bid.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="bid_amount">Bid Amount:</label>
            <input type="number" id="bid_amount" name="bid_amount" min="<?php echo htmlspecialchars($product['min_bid']); ?>" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message"></textarea>

            <button type="submit">Place Bid</button>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

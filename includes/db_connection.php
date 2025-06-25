<?php
// Database connection
$db = new SQLite3('database.sqlite');

// Create products table
$db->exec("CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    category TEXT NOT NULL,
    image TEXT NOT NULL,
    price REAL NOT NULL,
    description TEXT NOT NULL,
    min_bid REAL NOT NULL
)");

// Create bids table
$db->exec("CREATE TABLE IF NOT EXISTS bids (
    id INTEGER PRIMARY KEY,
    product_id INTEGER NOT NULL,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    bid_amount REAL NOT NULL,
    message TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(product_id) REFERENCES products(id)
)");
?>

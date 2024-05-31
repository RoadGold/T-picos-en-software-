<?php
require 'Product.php';

$product = new Product("Laptop", 1200.00, "High-end gaming laptop");

echo $product->getName();
echo $product->getPrice();
echo $product->getDescription();
?>
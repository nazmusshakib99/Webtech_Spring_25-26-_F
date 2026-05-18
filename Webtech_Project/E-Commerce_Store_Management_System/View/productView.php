<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

require_once "../Model/productModel.php";

$id = $_GET['id'] ?? 0;

$model = new ProductModel();
$product = $model->getProductById($id);
$averageRating = $model->getAverageRating($id);
$reviews = $model->getReviewsByProduct($id); // ✅ ADD THIS

if(!$product){
    echo "Product not found";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo htmlspecialchars($product['name']); ?></title>

<link rel="stylesheet" href="../View/Style/homeStyle.css">
<link rel="stylesheet" href="../View/Style/productStyle.css">
</head>

<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<div class="product-container">

<div class="product-image">
<img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>">
</div>

<div class="product-details">

<h2><?php echo htmlspecialchars($product['name']); ?></h2>

<p class="price">$<?php echo number_format($product['price'], 2); ?></p>

<p class="stock">
<?php echo intval($product['stock_qty']) > 0 ? 'In Stock: ' . intval($product['stock_qty']) : 'Out of Stock'; ?>
</p>

<p class="rating">
Average Rating:
<?php echo $averageRating === null ? 'No ratings yet' : $averageRating . ' / 5 ⭐'; ?>
</p>

<p class="description">
<?php echo nl2br(htmlspecialchars($product['description'])); ?>
</p>

</div>
</div>

<!-- ✅ REVIEW DISPLAY -->
<div class="review-section">

<h2>Customer Reviews</h2>

<?php if(empty($reviews)){ ?>
<p>No reviews yet</p>
<?php } else { ?>

<?php foreach($reviews as $r){ ?>

<div class="review-card">

<h4><?php echo htmlspecialchars($r['name']); ?></h4>

<p>Rating: <?php echo str_repeat("⭐", $r['rating']); ?></p>

<p><?php echo htmlspecialchars($r['comment']); ?></p>

<small><?php echo $r['created_at']; ?></small>

</div>

<?php } ?>

<?php } ?>

</div>

<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
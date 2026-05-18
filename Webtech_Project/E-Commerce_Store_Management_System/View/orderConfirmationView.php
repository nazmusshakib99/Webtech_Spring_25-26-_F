<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: loginView.php?error=Please login first");
    exit();
}

require_once "../Model/orderModel.php";
require_once "../Model/reviewModel.php";

$model = new OrderModel();
$reviewModel = new ReviewModel();

$orderId = $_GET['id'] ?? 0;
$summary = $model->getOrderSummary($orderId, $_SESSION['user_id']);

if(!$summary){
    echo "Order not found";
    exit();
}

$order = $summary['order'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Confirmation</title>

<link rel="stylesheet" href="Style/homeStyle.css">
<link rel="stylesheet" href="Style/cartStyle.css">

</head>

<body>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<main class="confirmation-page">

<h2>Order Confirmed</h2>

<p>Order ID: <strong>#<?php echo $order['id']; ?></strong></p>
<p>Status: <?php echo htmlspecialchars($order['status']); ?></p>
<p>Payment: <?php echo htmlspecialchars($order['payment_method']); ?></p>
<p>Shipping Address: <?php echo htmlspecialchars($order['shipping_address']); ?></p>

<h3>Summary</h3>

<?php foreach($summary['items'] as $item){ ?>

<div class="confirmation-item">

<span>
<img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" width="60">
<?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['quantity']; ?>
</span>

<strong>$<?php echo number_format($item['quantity'] * $item['unit_price'], 2); ?></strong>

</div>

<!-- ✅ REVIEW SECTION -->
<?php 
$productId = $item['product_id'] ?? null;

if($productId && strtolower($order['status']) == 'delivered'){ 

$canReview = $reviewModel->canReview($_SESSION['user_id'], $productId);
?>

<div class="review-box">

<?php if($canReview){ ?>

<form class="reviewForm">

<input type="hidden" name="product_id" value="<?php echo $productId; ?>">

<label>Rating:</label><br>

<input type="radio" name="rating" value="5" required> ⭐⭐⭐⭐⭐
<input type="radio" name="rating" value="4"> ⭐⭐⭐⭐
<input type="radio" name="rating" value="3"> ⭐⭐⭐
<input type="radio" name="rating" value="2"> ⭐⭐
<input type="radio" name="rating" value="1"> ⭐

<br><br>

<textarea name="comment" placeholder="Write your review" required></textarea>

<br><br>

<button type="button" onclick="submitReview(this)">Submit Review</button>

</form>

<?php } else { ?>

<p class="review-done">✔ You already reviewed this product</p>

<?php } ?>

</div>

<?php } ?>

<?php } ?>

<div class="summary-item">
<span>Total</span>
<strong>$<?php echo number_format($order['total_amount'], 2); ?></strong>
</div>

<a class="checkout-link" href="homeView.php">Continue Shopping</a>

</main>

<script src="../Controller/JS/review.js"></script>
<script src="../Controller/JS/liveSearch.js"></script>

</body>
</html>
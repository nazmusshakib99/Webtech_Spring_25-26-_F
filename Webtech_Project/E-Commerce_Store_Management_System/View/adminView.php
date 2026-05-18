<?php
session_start();
require_once "../Config/helper.php";
require_admin();

require_once "../Model/adminModel.php";

$model = new AdminModel();
$products = $model->getAllProducts();
$categories = $model->getCategories();

// 🔥 ORDER FILTER
$status = $_GET['status'] ?? "";
$from = $_GET['from'] ?? "";
$to = $_GET['to'] ?? "";

$orders = $model->getAllOrders($status, $from, $to);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="../View/Style/adminStyle.css">
<script src="../Controller/JS/admin.js"></script>
</head>

<body>

<div class="header">
    <h2>Admin Dashboard</h2>
    <a href="../Controller/logout.php" class="logout">Logout</a>
</div>

<!-- ================= PRODUCT ADD ================= -->
<div class="form-container">
<h3>Add Product</h3>

<form id="addForm" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Product Name" required>
<textarea name="description" placeholder="Description"></textarea>
<input type="number" name="price" placeholder="Price" required>
<input type="number" name="stock" placeholder="Stock" required>

<select name="category_id" required>
<option value="">Select Category</option>
<?php while($cat = mysqli_fetch_assoc($categories)){ ?>
<option value="<?php echo $cat['id']; ?>">
<?php echo isset($cat['parent_id']) && $cat['parent_id'] ? "-- ".$cat['name'] : $cat['name']; ?>
</option>
<?php } ?>
</select>

<input type="file" name="image" required>

<button type="button" onclick="addProduct()">Add Product</button>

<p id="msg"></p>
</form>
</div>

<!-- ================= PRODUCT LIST ================= -->
<table>
<tr>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($products)){ ?>
<tr class="<?php echo ($row['stock_qty'] <= 5) ? 'low-stock' : ''; ?>">

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $row['stock_qty']; ?></td>

<td>
<span class="badge <?php echo $row['is_available'] ? 'in' : 'out'; ?>"
onclick="toggleStock(<?php echo $row['id']; ?>)">
<?php echo $row['is_available'] ? 'In Stock' : 'Out'; ?>
</span>
</td>

<td>
<a href="../Controller/editProduct.php?id=<?php echo $row['id']; ?>">Edit</a> |
<a href="../Controller/adminValidation.php?delete=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>
<?php } ?>
</table>

<!-- ================= ORDER MANAGEMENT ================= -->
<div class="form-container">
<h3>Order Management</h3>

<form method="GET">

<select name="status">
<option value="">All Status</option>
<option value="Pending">Pending</option>
<option value="Processing">Processing</option>
<option value="Shipped">Shipped</option>
<option value="Delivered">Delivered</option>
<option value="Cancelled">Cancelled</option>
</select>

<input type="date" name="from">
<input type="date" name="to">

<button type="submit">Filter</button>

</form>
</div>

<table>
<tr>
<th>ID</th>
<th>User</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php while($order = mysqli_fetch_assoc($orders)){ ?>
<tr>

<td>#<?php echo $order['id']; ?></td>
<td><?php echo $order['user_id']; ?></td>
<td>$<?php echo $order['total_amount']; ?></td>

<td>
<select onchange="updateOrder(this, <?php echo $order['id']; ?>)">

<option <?php if($order['status']=="Pending") echo "selected"; ?>>Pending</option>
<option <?php if($order['status']=="Processing") echo "selected"; ?>>Processing</option>
<option <?php if($order['status']=="Shipped") echo "selected"; ?>>Shipped</option>
<option <?php if($order['status']=="Delivered") echo "selected"; ?>>Delivered</option>
<option <?php if($order['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>

</select>
</td>

<td><?php echo $order['created_at']; ?></td>

</tr>
<?php } ?>
</table>

</body>
</html>
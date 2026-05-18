<?php
require_once "../Model/adminModel.php";

$model = new AdminModel();

/* ================= ADD PRODUCT (AJAX) ================= */
if(isset($_POST['action']) && $_POST['action'] == "add"){

    // IMAGE CHECK
    if(isset($_FILES['image']) && $_FILES['image']['size'] > 3*1024*1024){
        echo "Image must be under 3MB";
        exit();
    }

    // IMAGE UPLOAD
  $image = "";

if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
    
    $image = time() . "_" . $_FILES['image']['name'];

    $target = "../uploads/" . $image;

    move_uploaded_file($_FILES['image']['tmp_name'], $target);
}

    $_POST['image'] = $image;

    $model->addProduct($_POST);

    echo "Product Added Successfully";
    exit();
}


/* ================= DELETE PRODUCT ================= */
if(isset($_GET['delete'])){
    $model->deleteProduct($_GET['delete']);
    header("Location: ../View/adminView.php");
    exit();
}


/* ================= TOGGLE STOCK ================= */
if(isset($_POST['toggle'])){
    $model->toggleStock($_POST['id']);
    echo "ok";
    exit();
}


/* ================= UPDATE PRODUCT ================= */
if(isset($_POST['action']) && $_POST['action'] == "update"){

    // IMAGE (OPTIONAL UPDATE)
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/products/".$image);
        $_POST['image'] = $image;
    }

    $model->updateProduct($_POST);

    echo "Product Updated Successfully";
    exit();
}


/* ================= UPDATE ORDER STATUS ================= */
if(isset($_POST['updateOrder'])){

    $id = $_POST['id'];
    $status = $_POST['status'];

    $model->updateOrderStatus($id, $status);

    echo json_encode(["ok"=>true]);
    exit();
}
?>
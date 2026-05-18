<?php
session_start();
require_once "../Model/reviewModel.php";

header("Content-Type: application/json");

if(!isset($_SESSION['user_id'])){
    echo json_encode(["ok"=>false, "msg"=>"Login required"]);
    exit();
}

if(!isset($_POST['product_id'], $_POST['rating'], $_POST['comment'])){
    echo json_encode(["ok"=>false, "msg"=>"All fields required"]);
    exit();
}

$model = new ReviewModel();

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);
$rating = intval($_POST['rating']);
$comment = trim($_POST['comment']);

// validation
if($rating < 1 || $rating > 5){
    echo json_encode(["ok"=>false, "msg"=>"Invalid rating"]);
    exit();
}

if(empty($comment)){
    echo json_encode(["ok"=>false, "msg"=>"Comment cannot be empty"]);
    exit();
}

$result = $model->addReview($user_id, $product_id, $rating, $comment);

if($result == "already"){
    echo json_encode(["ok"=>false, "msg"=>"You already reviewed this product"]);
}
else if($result == "success"){
    echo json_encode(["ok"=>true]);
}
else{
    echo json_encode(["ok"=>false, "msg"=>"Error submitting review"]);
}
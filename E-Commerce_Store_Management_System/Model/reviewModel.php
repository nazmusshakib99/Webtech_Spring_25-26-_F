<?php
require_once "db.php";

class ReviewModel extends Database {

    public function addReview($user_id, $product_id, $rating, $comment){

    $conn = $this->connection();

    // check duplicate
    $check = mysqli_query($conn, "SELECT * FROM reviews 
    WHERE user_id='$user_id' AND product_id='$product_id'");

    if(mysqli_num_rows($check) > 0){
        return "already";
    }

    // insert
    $sql = "INSERT INTO reviews (user_id, product_id, rating, comment)
            VALUES ('$user_id', '$product_id', '$rating', '$comment')";

    if(mysqli_query($conn, $sql)){
        return "success";
    }

    return "error";
}

public function canReview($userId, $productId){

    $conn = $this->connection();

    $sql = "SELECT id FROM reviews 
            WHERE user_id='$userId' AND product_id='$productId'";

    $result = mysqli_query($conn, $sql);

    return mysqli_num_rows($result) == 0;
}

}
?>
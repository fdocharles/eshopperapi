<?php
include 'cors.php'; 

include 'connect.php' ;

$_POST = json_decode(file_get_contents("php://input"),true);

if($_POST)
{
    $comment = $_POST['comment'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $productId = $_POST['productId'];

    // prepare and bind
    
    $stmt = null;


    if($id > 0)
    {
        $stmt = $conn->prepare("UPDATE review SET comment = ? WHERE id = ?");
        $stmt->bind_param('sd',$comment, $id);
        
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO review(product_id,customer_name,comment,rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('dssd',$productId, $name, $comment, $rating);
    }

    $stmt->execute();

}


$conn->close();



echo $_POST['id'];
?>
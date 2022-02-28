<?php

include 'cors.php'; 
include 'connect.php' ;

$_POST = json_decode(file_get_contents("php://input"),true);

// if($_POST)
// {
    // //get all products
    $sql = "Select * from Customer where Email = '". $_POST["email"] . "' AND Password = '". $_POST["password"]. "'";
    $result = $conn->query($sql);
    $pro = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data['id'] = $row['Id'];
            $data['name'] = $row['Name'];
            $data['avatar'] = $row['Avatar'];
            
            $pro['data'] = $data;
        }
        
        
        echo json_encode($pro);

    }
    else
    {
        http_response_code(401);
        exit;
    }


$conn->close();


?>
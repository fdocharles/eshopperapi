<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include 'connect.php' ;


//get all products
$sql = "Select * from product";
$result = $conn->query($sql);
$pro = [];

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['name'] = $row['name'];
        $data['category'] = $row['category'];
        $data['price'] = $row['price'];
        $data['image'] = $row['image'];
        $data['featured'] = $row['featured'];
        $pro['data'][] = $data;
    }
    $pro['num'] = $result->num_rows;
    
    echo json_encode($pro);

}
$conn->close();
?>
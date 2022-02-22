<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include 'connect.php' ;

//get all products
$sql = "Select * from product where id = ". $_GET["id"];
$result = $conn->query($sql);
$pro = [];

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['name'] = $row['name'];
        $data['category'] = $row['category'];
        $data['description'] = $row['description'];
        $data['price'] = $row['price'];
        $data['image'] = $row['image'];

        $sql1 = "Select id, customer_name , comment , rating from review where product_id = ". $_GET["id"];
        $result1 = $conn->query($sql1);

        while($row1 = $result1->fetch_assoc()){
            $data1['id'] = $row1['id'];
            $data1['cust_name'] = $row1['customer_name'];
            $data1['comment'] = $row1['comment'];
            $data1['rating'] = $row1['rating'];
            $data['reviews'][] = $data1;
        }
        
        $pro['data'][] = $data;
    }
    
    
    echo json_encode($pro);

}
$conn->close();


?>
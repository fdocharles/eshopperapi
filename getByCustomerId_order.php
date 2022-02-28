<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include 'connect.php' ;

//get all products
$sql = "Select * from orders where cust_name = '".$_GET["id"]."'";

$result = $conn->query($sql);
$pro = [];

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data['id'] = $row['id'];
        $data['cust_name'] = $row['cust_name'];
        $data['order_no'] = $row['order_no'];
        $data['is_placed'] = $row['is_placed'];

        $sql1 = "   SELECT c.*, p.name as product_name
                    FROM cart c
                    JOIN Product p ON c.product_id = p.id 
                    WHERE order_id = ". $row['id'];
        $result1 = $conn->query($sql1);

        while($row1 = $result1->fetch_assoc()){
            $data1['id'] = $row1['id'];
            $data1['order_id'] = $row1['order_id'];
            $data1['product_id'] = $row1['product_id'];
            $data1['qty'] = $row1['qty'];
            $data1['price'] = $row1['price'];
            $data1['tax'] = $row1['tax'];
            $data1['total'] = $row1['total'];
            $data1['product_name'] = $row1['product_name'];
            $data['items'][] = $data1;
        }
        
        $pro['data'][] = $data;
    }
    
    
    echo json_encode($pro);

}
$conn->close();


?>
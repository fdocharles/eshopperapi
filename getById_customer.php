<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include 'connect.php' ;

//get all products
$sql = "Select * from customer where Id = ". $_GET["id"];
$result = $conn->query($sql);
$pro = [];

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $data['Id'] = $row['Id'];
        $data['Name'] = $row['Name'];
        $data['Avatar'] = $row['Avatar'];
        
        $pro['data'] = $data;
    }
    
    
    echo json_encode($pro);

}
$conn->close();


?>
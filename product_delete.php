<?php

include('connect.php');

if(isset($_POST['d'])){ 
    $del_arr = explode("x", $_POST['d']); 

    foreach($del_arr as $del):

        $sql = "DELETE FROM product WHERE ID = :id";
        $stmt = $connection->prepare($sql);
        $stmt->execute(["id"=>$del]);
      
     endforeach;  
}

mysqli_close($connection);

?>
<?php

	include('connect.php');
    $stmt = $connection->query('SELECT ID, SKU, Names, Price, Attribute FROM product ORDER BY ID');

    $items =[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($items, $row);
    }	
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <title>Product list</title>    
</head>
<body>
    <header>               
            <div class="container1">
                <nav id="navbar">  
                <h2>Product List</h2>
                    <ul>
                        <li><a href="index2.php" ><button type="button" class="one" >Add</button></a></li>
                        <li><a href="javascript:void(0)" onclick="" ><button class="buttonMD" name="md">Mass Delete</button></a></li>  
                    </ul>                             
                </nav>
            </div>        
    </header>
    <hr>
    <section class="product listing">
        <div class="container2">
           <div class="row"> 
                <?php foreach($items as $item): ?>            
                        <div class="box">                            
                            <input type="checkbox" name="deleted" value=<?php echo htmlspecialchars($item['ID'])?> class="checkbox">
                            <p><?php echo htmlspecialchars($item['SKU']) ?></p>
                            <p><?php echo htmlspecialchars($item['Names']) ?></p>
                            <p><?php echo htmlspecialchars($item['Price']) . "$" ?></p>                           
                            <p><?php echo htmlspecialchars($item['Attribute']) ?></p>                           
                        </div> 
                <?php endforeach; ?>
            </div>
            <div class="clear"></div>  
        </div>               
    </section>    
    <hr>
    <footer>
        <div class="container3">
            <h4></h4>
        </div>
    </footer>    
    <script src="script1.js"></script>
</body>
</html>
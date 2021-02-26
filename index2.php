<?php
    
    include('connect.php');
    require('product_validation.php');
    require('product_writer.php');

    if(isset($_GET['SKU'])){
      $validation = new ProductValidator($_GET);
      $errors = $validation->validateForm();
          
      if(count($errors)>0){
          print_r($errors);
      } else {
        $pw = new Product_Writer($_GET, $connection);
        $pw->writeProduct();
        header('Location: index.php');
      }     
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="styles2.css?refreshcss=1">
    <link rel="stylesheet" href="styles3.css?refreshcss=1">
    <title>Product Add</title>
    
</head>
<body>
    <header>               
            <div class="container1">
                <nav id="navbar">  
                <h2>Product Add</h2>
                    <ul>                        
                        <li><a href="javascript:void(0)" onclick=""><button id="buttonSave">Save</button></a></li>
                        <li><a href="index.php" onclick="" ><button id="buttonCancel">Cancel</button></a></li> 
                    </ul>                             
                </nav>
            </div>        
    </header>
    <hr>
  <section>
  <div class="container2">
        <form action="index2.php" method="get" class="addForm" id="productForm">            
            <div class="addFormDiv">
                <label for="SKU">SKU</label>
                <input type="text" id="SKU" name="SKU" class="selected">
                <p class="addFormParagraph">Please provide data of indicated type (alphanumeric, 8-12 characters)</p>                
            </div>    
            <div class="addFormDiv">
                <label for="Name">Name</label>
                <input type="text" id="Name" name="Name" class="selected">
                <p class="addFormParagraph">Please provide data of indicated type (letters)</p>                
            </div>
            <div class="addFormDiv">   
                <label for="Name">Price $</label>
                <input type="text" id="Price" name="Price" class="selected">
                <p class="addFormParagraph">Please provide data of indicated type (numeric, to 1 or 2 decimal places)</p>            
            </div>
            <div class="addFormDiv">   
                <label for="type">Type</label>
                <select name="Type" id="Type" class="selected">
                    <option value="DVD-disc">DVD-disc</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>   
                <p class="addFormParagraph"></p>
            </div>                       
            <div id="DVDDiv" style="display:none" >
                <div class="specialFormDiv">
                    <label for="sizeDVD">Size (MB)</label>
                    <input type="text" id="Megabytes" name="Megabytes" class="specialInput">   
                    <p class="specialFormParagraph">  *Please provide the size in megabytes for the DVD-disc</p>                   
                </div>                
            </div>             
            <div id="bookDiv" style="display:none">
                <div class="specialFormDiv">
                    <label for="weightBook">Weight (KG)</label>
                    <input type="text" id="Kilograms" name="Kilograms" class="specialInput">   
                    <p class="specialFormParagraph"> </p>                   
                </div>
            </div>
        
            <div id="furnitureDiv" style="display:none">
                <div class="specialFormDiv">
                    <label for="heightFurniture">Height (CM)</label>
                    <input type="text" id="CentimetersH" name="CentimetersH" class="specialInput" >            
                    <p class="specialFormParagraph"> </p>
                </div>
                <div class="specialFormDiv">
                    <label for="widthFurniture">Width (CM)</label>
                    <input type="text" id="CentimetersW" name="CentimetersW" class="specialInput">   
                    <p class="specialFormParagraph"> </p>    
                </div>
                <div class="specialFormDiv">
                    <label for="lengthFurniture">Length (CM)</label>
                    <input type="text" id="CentimetersL" name="CentimetersL" class="specialInput">                    
                    <p class="specialFormParagraph">  *Please provide the dimensions in centimeters for the furniture</p>                    
                </div>
            </div>
     
        </form>    
    </div>
  </section>    
    <hr>

    <footer>
        <div class="container3">
            <h4>Scandiweb Test assignment</h4>
        </div>
    </footer>   
    
    <script src="script2.js"></script>
</body>
</html>
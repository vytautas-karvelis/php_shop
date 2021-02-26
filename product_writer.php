<?php   

    class Product_Writer {
        
        private $data;
        private $type = [];        
        private $connection;
        public function __construct ($data, $connection){            
            $this->data = $data;   
            $this->connection = $connection;                
        }

        public function writeProduct(){  

            $products = ["Book" => 'writeBook',
                         "Furniture" => 'writeFurniture',
                         "DVD-disc" => 'writeDVDdisk'            
                        ];            
            $func = $products[$this->data['Type']];
            call_user_func(array("Product_Writer", $func)); 
            
        }

        public static function writeBook(){
            
            $SKU = $this->data["SKU"];
            $Names =  $this->data["Name"];
            $Price = $this->data["Price"];
            $Attribute = "Weight: " . $this->data["Kilograms"] . "KG";   
            
            $sql = "INSERT INTO product(SKU,Names,Price,Attribute)
            VALUES(:SKU, :Names, :Price, :Attribute)";           

           $stmt = $this->connection->prepare($sql);
           $stmt->execute(['SKU'=>$SKU, 'Names'=>$Names, 'Price'=>$Price, 'Attribute'=>$Attribute]);
        }

        public static function writeDVDdisk(){
            
            $SKU =  $this->data["SKU"];
            $Names =  $this->data["Name"];
            $Price =  $this->data["Price"];

            $Attribute = "Size: " . $this->data["Megabytes"] . "MB";            
            
            $sql = "INSERT INTO product(SKU,Names,Price,Attribute)
            VALUES(:SKU, :Names, :Price, :Attribute)";  
           
           $stmt = $this->connection->prepare($sql);
           $stmt->execute(['SKU'=>$SKU, 'Names'=>$Names, 'Price'=>$Price, 'Attribute'=>$Attribute]); 
        }

        public function writeFurniture(){
            
            $SKU =  $this->data["SKU"];
            $Names =  $this->data["Name"];
            $Price =  $this->data["Price"];

            $Attribute = "Dimension:".$this->data["CentimetersH"]. "x".$this->data["CentimetersW"]. "x"
            .$this->data["CentimetersL"];                  
            
            $sql = "INSERT INTO product(SKU,Names,Price,Attribute)
            VALUES(:SKU, :Names, :Price, :Attribute)";          

            $stmt = $this->connection->prepare($sql);
            $stmt->execute(['SKU'=>$SKU, 'Names'=>$Names, 'Price'=>$Price, 'Attribute'=>$Attribute]);  
        }      

    }

?>
<?php 

    class ProductValidator {

        private $data;
        private $type;
        private $errors = [];        
        private static $fields = array(
                "Book" =>array("SKU", "Name", "Price", "Kilograms"),
                "DVD-disc" =>array("SKU", "Name", "Price", "Megabytes"),
                "Furniture"=>array("SKU", "Name", "Price","CentimetersH","CentimetersW", "CentimetersL")
                );

        public function __construct($postdata){
            $this->data = $postdata; 
        }

        public function validateForm(){            
            $this->validateProduct();
            return $this->errors;
        }

        public function validateProduct(){
            $this->determineType();
            switch($this->type){
                case "DVD-disc":
                    $this->validateDVDdisc();                    
                    break;
                case "Book":
                    $this->validateBook();                    
                    break;
                case "Furniture":
                    $this->validateFurniture();                    
                    break;   
            }

        }

        public function determineType(){
            $types = ['Book', "DVD-disc", "Furniture"];
            $type = $this->data["Type"];            
            if(!in_array($type, $types)){
                trigger_error("$type is not present");
                return;
            }
            $this->type = $type;

        }

        public function validateDVDdisc(){

            $this->checkFields("DVD-disc");  
            $this->validateMainProperties();
            $megabytes = trim($this->data['Megabytes']);
            if(empty($megabytes)){
              $this->addError('Megabytes', 'Megabytes cannot be empty');
            } else {
              if(!preg_match('/(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/', $megabytes)){
                $this->addError('Megabytes', 'Megabytes must be valid');
              }
            } 
        }

        public function validateBook(){

            $this->validateMainProperties();
            $this->checkFields("Book");               
            $kilograms = trim($this->data['Kilograms']);
            if(empty($kilograms)){
              $this->addError('Kilograms', 'Kilograms cannot be empty');
            } else {
              if(!preg_match('/(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/', $kilograms)){
                $this->addError('Kilograms', 'Kilograms must be valid');
              }
            } 
        }

        public function validateFurniture(){

            $this->validateMainProperties();
            $this->checkFields("Furniture");                 
            $centimetersH = trim($this->data['CentimetersH']);
            if(empty($centimetersH)){
              $this->addError('Centimeters height', 'Centimeters height cannot be empty');
            } else {
              if(!preg_match('/(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/', $centimetersH)){
                $this->addError('Centimeters height',  'Centimeter height must be valid');
              }
            } 
            $centimetersW = trim($this->data['CentimetersW']);
            if(empty($centimetersW)){
                $this->addError('Centimeters width', 'Centimeters width cannot be empty');
              } else {
                if(!preg_match('/(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/', $centimetersW)){
                  $this->addError('Centimeters width',  'Centimeter width must be valid');
                }
              }
            $centimetersL = trim($this->data['CentimetersL']);
            if(empty($centimetersL)){
                $this->addError('Centimeters length', 'Centimeters length cannot be empty');
              } else {
                if(!preg_match('/(^\d*\.?\d*[1-9]+\d*$)|(^[1-9]+\d*\.\d*$)/', $centimetersL)){
                  $this->addError('Centimeters length',  'Centimeter length must be valid');
                }
              } 
             
        }

        public function validateMainProperties(){

            $SKU = trim($this->data['SKU']);
            if(empty($SKU)){
              $this->addError('SKU', 'SKU cannot be empty');
            } else {
              if(!preg_match('/^[\dA-Z]{8,12}$/', $SKU)){
                $this->addError('SKU', 'SKU must be valid');
              }
            }

            $name = trim($this->data['Name']);
            if(empty($name)){
              $this->addError('Name', 'Name cannot be empty');
            } else {
              if(!preg_match('/^[a-z]{1,30}$/i', $name)){
                $this->addError('Name', 'Name must be valid');
              }
            }
            
            $price = trim($this->data['Price']);
            if(empty($price)){
              $this->addError('Price', 'Price cannot be empty');
            } else {
              if(!preg_match('/^(\d+)(\.(\d){1,2})?$/', $price)){
                $this->addError('Price', 'Price must be valid');
              }
            }

            $type = trim($this->data['Type']);
            if(empty($type)){
              $this->addError('Type', 'Type cannot be empty');
            } else {
              if(!preg_match('/^[a-z-]+$/i', $type)){
                $this->addError('Type', 'Type must be valid');
              }
            }

        }

        private function checkFields($product){
            foreach(self::$fields[$product] as $field){
                if(!array_key_exists($field, $this->data)){
                    trigger_error("$field is not present");
                    return;
                }
            }
        }

        private function addError($key, $val){
            $this->errors[$key] = $val;
        }        

    }

?>
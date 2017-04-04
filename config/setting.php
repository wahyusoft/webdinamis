<?php
  include_once("const.php");
  

  function connectDB($config){	
    try {
      $host = $config["host"];
      $db = $config["db"];
      $username = $config["username"];
      $password = $config["password"]; 
      $conn = new PDO("mysql:host=$host;dbname=$db",  $username, $password);    
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      return $conn;	  
    } catch (PDOException $e) {
      echo "Connection failed: ".$e->getMessage();  
    }
  }

  function main_menu()
  {
     $config = array("host"=>"localhost",
                     "username"=>"root",
                     "password"=>"",
                     "db"=>"northwind");
     $conn = connectDB($config);
     $pages=(isset($_GET["pages"] ))? $_GET["pages"] : '';
      switch($pages){
		case "category" :
          include_once(path."category/view.php");
          break;
		case "add_category" :  
		  include_once(path."category/form.php");
          break;
	    case "customer" :
          include_once(path."customers/view.php");
          break;	
		case "add_customer" :  
		  include_once(path."customers/form.php");
          break;	
        case "product" :
          include_once(path."products/view.php");
          break;
		case "add_product" :  
		  include_once(path."products/form.php");
          break;  
        case "home" :
          include_once(path."home/home.php");
          break;    
        default : 
          include_once(path."home/home.php");
          break;
      
      }
  
  }
  
  function navigation(){
    $pages=(isset($_GET["pages"] ))? $_GET["pages"] : '';  
    $array_menu=array(array('file'=>'home',
                            'label'=>'Home'),
                      array('file'=>'category',            
                            'label'=>'Category'),
					  array('file'=>'product',
                            'label'=>'Product'),
					  array('file'=>'customer',
					        'label'=>'Customers'));
						
    $menu='';
    foreach($array_menu as $row_menu){
      $css_act=(@$_GET["pages"]==$row_menu['file'])? 'id="submenu-active"' : '';
      $menu.='<li '.$css_act.' ><a href="index.php?pages='.$row_menu['file'].'"><i class="fa fa-circle-o"></i> '.$row_menu['label'].'</a>';
    }                      
    return $menu;
  }
  
?>
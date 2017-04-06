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
                     "db"=>"librarydb");
     $conn = connectDB($config);
     $pages=(isset($_GET["pages"] ))? $_GET["pages"] : '';
      switch($pages){
		case "authors" :
          include_once(path."authors/view.php");
          break;
		case "add_author" :  
		      include_once(path."authors/form.php");
          break;

        case "books" :
          include_once(path."books/view.php");
          break;
    case "add_book" :  
          include_once(path."books/form.php");
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
                      array('file'=>'authors',            
                            'label'=>'Authors'),
					  array('file'=>'books',
                            'label'=>'Books'));
						
    $menu='';
    foreach($array_menu as $row_menu){
      $css_act=(@$_GET["pages"]==$row_menu['file'])? 'id="submenu-active"' : '';
      $menu.='<li '.$css_act.' ><a href="index.php?pages='.$row_menu['file'].'"><i class="fa fa-circle-o"></i> '.$row_menu['label'].'</a>';
    }                      
    return $menu;
  }
  
?>
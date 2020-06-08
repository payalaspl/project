<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Categories.php";

// get latest posts from DB

$objCat = new Categories();
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	if(isset($_POST['frm_submit']) && $_POST['name'] != ""){
		if(isset($_POST['id']) && $_POST['id'] != ""){

			$insert = $objCat->insert("update  categories set `name` = '".$_POST['name']."',`description` = '".$_POST['description']."' where id='".$_POST['id']."'");
		}else{
			$insert = $objCat->insert("insert into categories(`name`,`description`) value('".$_POST['name']."','".$_POST['description']."')");
		}
		
		$categories = $objCat->select("SELECT * FROM categories ORDER BY  id desc");
        echo $twig->render('categories.html.twig', array('categories' => $categories));
	}else{
		echo $twig->render('add_categories.html.twig', array('msg' => 'add categories'));
	}
}else{
	echo $twig->render('admin_login.html.twig', array('msg' => 'admin login'));
}

?>



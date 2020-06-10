<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB

$objArt = new Article();
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	if(isset($_GET['id']) && $_GET['id'] != ""){
		
	//$art = $objArt->select_one("SELECT * FROM articles where id = '".$_GET['id']."'");
	//print_r($art);exit();
	$categories = $objArt->select("SELECT * FROM categories ORDER BY  id desc");
	$cat_name = $objArt->select("SELECT * FROM articles_cat where articles_id = '".$_GET['id']."'");
	
	$art = $objArt->select_one("SELECT a.id,a.name,a.description,a.image,GROUP_CONCAT(ac.cat_id  separator ', ') cat_name FROM articles as a left join articles_cat as ac on a.id = ac.articles_id left join categories as cat on cat.id = ac.cat_id where a.id = '".$_GET['id']."' group by a.id");
	//print_r($art);exit();

	echo $twig->render('update_art.html.twig', array('id' => $_GET['id'] , 'name' => $art['name']
		,'description' => $art['description'] ,'oldimage'=>$art['image'], 'image'=>'uploads/thumbs/'.$art['image'],'cat_name'=>'['.$art['cat_name'].']','categories' => $categories,'msg' => 'update article'));
	}	
}else{
	echo $twig->render('admin_login.html.twig', array('msg' => 'admin login'));
}
?>





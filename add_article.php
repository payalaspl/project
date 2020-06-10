<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB

$objArt = new Article();
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
	if(isset($_POST['frm_submit']) && $_POST['name'] != "" && !empty($_FILES['image']['name'])){
    //call thumbnail creation function and store thumbnail name
		//print_r($_POST['cat']);exit();
    $upload_img = $objArt->cwUpload('image','uploads/','',TRUE,'uploads/thumbs/','200','160');
    //full path of the thumbnail image
    $thumb_src = 'uploads/thumbs/'.$upload_img;
   // print_r($thumb_src);exit();
	$insert = $objArt->insert_id("insert into articles(`name`,`description`,`image`) value('".$_POST['name']."','".$_POST['description']."','".$upload_img."')");
	foreach ($_POST['cat'] as $key => $value) {
		$insert_Cat = $objArt->insert("insert into articles_cat(`cat_id`,`articles_id`) value('".$value."','".$insert."')");
	}
		$categories = $objArt->select("SELECT * FROM categories ORDER BY  id desc");
		$msg = "Article Succefully Add";
	}else{
		$categories = $objArt->select("SELECT * FROM categories ORDER BY  id desc");
		$msg = "add articles";
	}
	echo $twig->render('add_article.html.twig', array('categories' => $categories,'msg' => $msg));
}else{
	echo $twig->render('admin_login.html.twig', array('msg' => 'admin login'));
}
?>




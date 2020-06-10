<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB

$objArt = new Article();
if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != ""){
		if(isset($_POST['frm_submit']) && $_POST['name'] != ""){
			$delete = $objArt->insert("delete from articles_cat where articles_id = '".$_POST['id']."'");
			if (!empty($_FILES['image']['name'])) {
				unlink('uploads/thumbs/'.$oldimage);
				unlink('uploads/'.$oldimage);
				$upload_img = $objArt->cwUpload('image','uploads/','',TRUE,'uploads/thumbs/','200','160');
				$insert = $objArt->insert("update articles set `name`= '".$_POST['name']."',`description` = '".$_POST['description']."',`image`='".$upload_img."' where id ='".$_POST['id']."'");
				foreach ($_POST['cat'] as $key => $value) {
					$insert_Cat = $objArt->insert("insert into articles_cat(`cat_id`,`articles_id`) value('".$value."','".$_POST['id']."')");
				}
			}else{
				$insert = $objArt->insert("update articles set `name`= '".$_POST['name']."',`description` = '".$_POST['description']."' where id ='".$_POST['id']."'");
				foreach ($_POST['cat'] as $key => $value) {
					$insert_Cat = $objArt->insert("insert into articles_cat(`cat_id`,`articles_id`) value('".$value."','".$_POST['id']."')");
				}
			}
		    
			
			
			$msg = "update artices";
			echo $twig->render('email.html.twig', array('msg' => $msg));
		}
}
?>

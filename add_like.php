<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB

$objArt = new Article();
if(isset($_SESSION['user_login']) && $_SESSION['user_login'] != ""){
	if(isset($_GET['id']) && $_GET['id'] != ""){
		$checklike = $objArt->select_one("select * from likes where article_id='".$_GET['id']."' and user_id ='".$_SESSION['user_login']."'");
		if($checklike){
			$art = $objArt->select_one("SELECT  ar.id,ar.image,ar.name,ar.description,count(ls.id) as count_like from articles ar left join likes ls on ar.id = ls.article_id  where ar.id ='".$_GET['id']."'");
			echo $twig->render('detail.html.twig', array('art' => $art,'user_login'=>$_SESSION['user_login']));
		}else{
			$insert = $objArt->insert("insert into likes(`article_id`,`user_id`) value('".$_GET['id']."','".$_SESSION['user_login']."')");
			$art = $objArt->select_one("SELECT  ar.id,ar.image,ar.name,ar.description,count(ls.id) as count_like from articles ar left join likes ls on ar.id = ls.article_id  where ar.id ='".$_GET['id']."'");
			echo $twig->render('detail.html.twig', array('art' => $art,'user_login'=>$_SESSION['user_login']));
		}
	}
}
?>





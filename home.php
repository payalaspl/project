<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";

// get latest posts from DB
$objArt = new Article();
$limit = 10 ; // Number of entries to show in a page. 
// Look for a GET variable page if not found default is 1.      
if (isset($_GET["page"])) {  
  $pn  = $_GET["page"];  
}  
else {  
  $pn=1;  
};   

$start_from = ($pn-1) * $limit; 
$art = $objArt->select("SELECT * FROM articles  ORDER BY  id DESC LIMIT $start_from, $limit");
$total = $objArt->select("SELECT * FROM articles");
$total_pages = ceil(count($total) / $limit); 
echo $twig->render('posts.html.twig', array('articles' => $art,'count'=>$total_pages));
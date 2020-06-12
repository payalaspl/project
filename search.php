<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Article.php";
require_once __DIR__ . "/models/Pagination.php";
// get latest posts from DB
$objArt = new Article();
$baseURL = 'getData.php'; 
$limit = 2; 

$result = $objArt->select_one("SELECT COUNT(*) as rowNum FROM  articles");
$rowCount= $result['rowNum']; 
$pagConfig = array( 
            'baseURL' => $baseURL, 
            'totalRows' => $rowCount, 
            'perPage' => $limit, 
            'contentDiv' => 'postContent', 
            'link_func' => 'searchFilter' 
        ); 
$pagination =  new Pagination($pagConfig); 


$art = $objArt->select("SELECT * FROM articles ORDER BY id DESC LIMIT $limit");
$data = $pagination->createLinks();

$categories = $objArt->select("SELECT * FROM categories ORDER BY  id desc"); 
echo $twig->render('search.html.twig', array('articles' => $art,'html'=>$data,'categories' => $categories));

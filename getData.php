<?php 

require_once __DIR__ . "/includes/common.php";

// include model classes as needed
require_once __DIR__ . "/models/Pagination.php";
require_once __DIR__ . "/models/Article.php";

if(isset($_POST['page'])){ 
    $objArt = new Article();
    $baseURL = 'getData.php'; 
    $offset = !empty($_POST['page'])?$_POST['page']:0; 
    $limit = 2; 
     
    // Set conditions for search 
    $whereSQL = $orderSQL = ''; 
    if(!empty($_POST['keywords']) && empty($_POST['sortBy'])){ 
        $whereSQL = "WHERE name LIKE '%".$_POST['keywords']."%' or description LIKE '%".$_POST['keywords']."%'";
        $result   = $objArt->select_one("SELECT COUNT(*) as rowNum FROM articles ".$whereSQL);
         $rowCount= $result['rowNum']; 

    } 
    elseif(!empty($_POST['sortBy']) && empty($_POST['keywords'])){
        $result   = $objArt->select( "select COUNT(*) as rowNum from articles_cat where cat_id in (".$_POST['sortBy'].") group by articles_id");
          if ($result) {
            $rowCount= count($result);
        }else{
            $rowCount = 0;
        } 
    }elseif (!empty($_POST['sortBy']) && !empty($_POST['keywords'])) {

        $result   = $objArt->select("select ar.id,ar.name,ar.description,ar.image from articles_cat ac left join articles ar on ar.id=ac.articles_id where ac.cat_id in (".$_POST['sortBy'].") and (ar.name LIKE '%".$_POST['keywords']."%' or ar.description LIKE '%".$_POST['keywords']."%') group by ac.articles_id ");
        if ($result) {
            $rowCount= count($result);
        }else{
            $rowCount = 0;
        }
        
     //   print_r($rowCount);exit();
    }
    else{ 
        $orderSQL = " ORDER BY name DESC ";
        $result   = $objArt->select_one("SELECT COUNT(*) as rowNum FROM articles ".$orderSQL);
         $rowCount= $result['rowNum']; 
    } 
     
    // Count of all records 
    
   
     
    // Initialize pagination class 
    $pagConfig = array( 
        'baseURL' => $baseURL, 
        'totalRows' => $rowCount, 
        'perPage' => $limit, 
        'currentPage' => $offset, 
        'contentDiv' => 'postContent', 
        'link_func' => 'searchFilter' 
    ); 
    $pagination =  new Pagination($pagConfig); 
 
    // Fetch records based on the offset and limit 
    //echo "SELECT * FROM articles $whereSQL $orderSQL LIMIT $offset,$limit";exit();
    if(!empty($_POST['keywords']) && empty($_POST['sortBy'])){ 
        $whereSQL = "WHERE name LIKE '%".$_POST['keywords']."%' or description LIKE '%".$_POST['keywords']."%'";
        $data = $objArt->select("SELECT * FROM articles $whereSQL  LIMIT $offset,$limit"); 
    } 
    elseif(!empty($_POST['sortBy']) && empty($_POST['keywords'])){
        $data   = $objArt->select( "select ar.id,ar.name,ar.description,ar.image from articles_cat ac left join articles ar on ar.id=ac.articles_id where ac.cat_id in (".$_POST['sortBy'].") group by ac.articles_id LIMIT $offset,$limit");
         
    }elseif (!empty($_POST['sortBy']) && !empty($_POST['keywords'])) {

        $data   = $objArt->select( "select ar.id,ar.name,ar.description,ar.image from articles_cat ac left join articles ar on ar.id=ac.articles_id where ac.cat_id in (".$_POST['sortBy'].") and (ar.name LIKE '%".$_POST['keywords']."%' or ar.description LIKE '%".$_POST['keywords']."%') group by ac.articles_id LIMIT $offset,$limit");
    }
    else{ 
        $orderSQL = " ORDER BY name DESC ";
        $data = $objArt->select("SELECT * FROM articles  $orderSQL LIMIT $offset,$limit"); 
    } 
    
    if($data){ 
    ?> 
        <!-- Display posts list --> 
        <div class="post-list"> 
        <?php foreach($data as $row){ ?>
             <p><img src="uploads/thumbs/<?php echo $row["image"]; ?>"></p>
             <p>Name : <?php echo $row["name"]; ?></p>
             <p>Description : <?php echo $row["description"]; ?></p>
        <?php } ?> 
        </div> 
         
        <!-- Display pagination links --> 
        <?php echo $pagination->createLinks(); ?> 
<?php 
    }else{ 
        echo '<p>Post(s) not found...</p>'; 
    } 
} 
?>


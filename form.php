<?php
// includes all necessary dependencies
require_once __DIR__ . "/includes/common.php";

// include model classes as needed

// get latest posts from DB
echo $twig->render('form.html.twig', array('msg' => 'register form'));



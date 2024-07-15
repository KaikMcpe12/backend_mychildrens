<?php
require_once 'model/read_reddit_model.php';

function clear($input){
    GLOBAL $conn;

    $var = $conn->escape_string($input);
    $var = htmlspecialchars($var);

    return $var;
};

function clear_page($page){
    if(!is_numeric($page)){
        header('Location: index.php');
    };

    $offset = ($page-1) * 2;
    
    return $offset;
};

function refresh($page){
    $id_user_reddit = $_SESSION['id_user'];
    // $id_user_reddit = 24;
    
    $page = clear_page($page);

    $results = read_reddit($id_user_reddit,  $page);

    return $results;
};

function get_all_page($tag='', $seach=''){
    $tag = clear($tag);
    $seach = clear($seach);

    $total_page = all_page($tag, $seach);
    return $total_page;
};

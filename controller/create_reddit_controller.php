<?php
require_once '../model/create_reddit_model.php';
session_start();

function clear($input){
    GLOBAL $conn;

    $var = $conn->escape_string($input);
    $var = htmlspecialchars($var);

    return $var;
};

if(isset($_POST['submit'])){
    $content_reddit = clear($_POST['content']);
    $title_reddit = clear($_POST["title"]);
    $id_user_reddit = $_SESSION['id_user'];
    
    $id_forum = created_reddit($content_reddit, $title_reddit, $id_user_reddit);

    $tags = $_POST['tags'];
    $tagsArray = explode(' ', $tags);
    $tagsArray = array_filter($tagsArray);

    created_tag($tagsArray);
    created_relation_tag($tagsArray, $id_forum);

    header('Location: ../index.php');
};
<?php 
require_once '../model/liked_reddit_model.php';
session_start();
$action = $_POST['action'];
$id_reddit = $_POST['id_reddit'];
$id_user = $_POST['id_user'];

if($action == 'like'){
    put_liked($id_user, $id_reddit);
}else if($action == 'dislike'){
    remove_liked($id_user, $id_reddit);
};

$likes = intval(update_like($id_reddit));

echo json_encode(array('likes' => $likes));

session_destroy();
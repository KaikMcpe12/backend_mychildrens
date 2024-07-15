<?php
require_once '../connect.php';
function put_liked($id_user, $id_reddit){
    GLOBAL $conn;

    $id_like = random_int(1,10**9);

    $sql = "INSERT INTO `like`(id_like, id_forum, id_user) VALUES ($id_like, $id_reddit, $id_user);";

    $conn->query($sql);
};

function remove_liked($id_user, $id_reddit){
    GLOBAL $conn;

    $sql = "SELECT id_like FROM `like` WHERE id_forum = '$id_reddit' AND id_user = '$id_user';";
    $id_like  = $conn->query($sql)->fetch_assoc()['id_like'];

    $sql = "DELETE FROM `like` WHERE id_like = '$id_like';";
    $conn->query($sql);
};

function update_like($id_reddit){
    GLOBAL $conn;

    $sql = "SELECT COUNT(id_like) FROM `like` WHERE id_forum = '$id_reddit';";
    return $conn->query($sql)->fetch_row()[0];
};
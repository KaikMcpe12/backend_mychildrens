<?php
require_once './connect.php';

function get_url_user($id_user){
    GLOBAL $conn;

    $sql = "SELECT url_image FROM user WHERE id_user = $id_user";
    $result = $conn->query($sql);

    $url_image = $result->fetch_assoc()['url_image'];

    return $url_image;
};
<?php
require_once './model/user_image_model.php';

function seach_image_user(){
    $int_url_image = get_url_user($_SESSION['id_user']);
    $url_image_user = "./assets/svg/users/user-$int_url_image.svg";

    return $url_image_user;
};
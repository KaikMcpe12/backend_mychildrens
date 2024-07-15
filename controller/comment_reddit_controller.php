<?php
require_once './model/comment_reddit_model.php';

function seach_reddit($id_user){
    $_SESSION['reddit'] = get_reddit($_SESSION['id_reddit'], $id_user);
};
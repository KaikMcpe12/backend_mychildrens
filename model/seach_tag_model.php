<?php
require_once './model/read_reddit_model.php';

function seach_tag_model($tag, $seach, $page){
    $id_user_reddit = $_SESSION['id_user'];

    $reddits = read_reddit($id_user_reddit, $page, $tag, $seach);

    return $reddits;
};

function get_all_tag(){
    GLOBAL $conn;

    $sql = "SELECT name FROM tag;";
    $result = $conn->query($sql);
    $tags_name = [];
    while($t = $result->fetch_assoc()){
        $tags_name[] = $t['name'];
    };

    return $tags_name;
}
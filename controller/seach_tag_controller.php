<?php
require_once './model/seach_tag_model.php';

function seach_tag_controller($tag, $seach, $page){
    $tag = clear($tag);
    $seach = clear($seach);
    $page = clear_page($page);

    $reddits = seach_tag_model($tag, $seach, $page);
    
    return $reddits;
};

function list_tag(){
    return get_all_tag();
};
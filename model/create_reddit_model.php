<?php
require_once '../connect.php';

function created_reddit($content, $title, $id_user){
    GLOBAL $conn;
    $stmt = $conn->prepare("INSERT INTO forum(id_forum, content, title, id_user) VALUES (?, ?, ?, ?);");
    $stmt->bind_param('issi', $id_forum, $content, $title, $id_user);

    $id_forum = random_int(1,10**9);
    
    $stmt->execute();

    return $id_forum;

    $stmt->close();
};

function created_tag($tags){
    GLOBAL $conn;

    $stmt = $conn->prepare("INSERT IGNORE INTO tag(id_tag, name) VALUES (?, ?);");
    $stmt->bind_param('is', $id_tag, $name_tag);

    foreach($tags as $tag){
        $id_tag = random_int(1,10**9);
        $name_tag = $tag;
        $stmt->execute();
    };
    $stmt->close();
};

function listed_tag($tags){
    GLOBAL $conn;

    $stmt = $conn->prepare("SELECT id_tag FROM tag WHERE name = ?");
    $stmt->bind_param('s', $name_tag);

    $array_id_tag = [];

    foreach($tags as $tag){
        $name_tag = $tag;
        $stmt->execute();

        $stmt->bind_result($id_tag);
        $stmt->fetch();
        if(!in_array($id_tag, $array_id_tag)){
            $array_id_tag[] = $id_tag;
        };
    };
    $stmt->close();

    return $array_id_tag;
};

function created_relation_tag($tags, $id_forum){
    GLOBAL $conn;
    $array_id_tag = listed_tag($tags);
    
    $stmt = $conn->prepare("INSERT INTO forum_has_tag(id_has_tag, id_forum, id_tag) VALUES (?, ?, ?);");
    $stmt->bind_param('iii', $id_has_tag, $id_forum, $id_tag);

    foreach($array_id_tag as $tag){
        $id_has_tag = random_int(1,10**9);
        echo $id_has_tag;
        $id_tag = $tag;
        $stmt->execute();
    };
    $stmt->close();
};
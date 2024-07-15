<?php
require_once 'connect.php';

function read_reddit($id_user, $page, $tag='', $seach=''){
    GLOBAL $conn;

    $sql = "SELECT
                f.*,
                u.*,
                GROUP_CONCAT(t.name SEPARATOR ', ') AS tags,
                CASE WHEN f.id_user = $id_user THEN 1 ELSE 0 END as author,
                CASE WHEN EXISTS (SELECT 1 FROM `like` WHERE id_forum = f.id_forum AND id_user = $id_user) THEN 1 ELSE 0 END AS user_like,
                (SELECT count(*) FROM `like` WHERE id_forum = f.id_forum) AS cont_like
            FROM forum f
            JOIN forum_has_tag AS ft ON f.id_forum = ft.id_forum
            JOIN tag AS t ON t.id_tag = ft.id_tag
            JOIN user AS u ON f.id_user = u.id_user
            GROUP BY f.id_forum
            HAVING tags LIKE '%$tag%' AND (f.title LIKE '%$seach%' OR f.content LIKE '%$seach%')
            ORDER BY f.date DESC
            LIMIT $page, 10;";
    $result = $conn->query($sql);

    $reddits = [];

    while ($row = $result->fetch_assoc()){
        $reddits[] = $row;
    };

    return $reddits;
};

function all_page($tag='', $seach=''){
    GLOBAL $conn;

    $sql = "SELECT COUNT(DISTINCT f.id_forum) AS total FROM forum AS f 
    JOIN  forum_has_tag AS ft ON f.id_forum = ft.id_forum 
    JOIN tag AS t ON ft.id_tag = t.id_tag
    WHERE t.name LIKE '%$tag%' AND (f.title LIKE '%$seach%' OR f.content LIKE '%$seach%')";
    $result = $conn->query($sql);
    $total_page = $result->fetch_assoc()['total'];
    
    $total_page = ceil($total_page/10);

    return $total_page;
};
<?php
require_once './connect.php';
function get_reddit($id_reddit, $id_user){
    GLOBAL $conn;

    $sql = "SELECT
    f.*,
    u.name,
    GROUP_CONCAT(t.name SEPARATOR ', ') AS tags,
    CASE WHEN f.id_user = $id_user THEN 1 ELSE 0 END as author,
    CASE WHEN l.id_user = $id_user THEN 1 ELSE 0 END AS user_like,
    count(l.id_like) AS cont_like
    FROM forum f
    JOIN forum_has_tag AS ft ON f.id_forum = ft.id_forum
    JOIN tag AS t ON t.id_tag = ft.id_tag
    JOIN user AS u ON f.id_user = u.id_user
    LEFT JOIN `like` AS l ON f.id_forum = l.id_forum AND l.id_user = $id_user
    WHERE f.id_forum = $id_reddit
    GROUP BY f.id_forum;";

    $result = $conn->query($sql);
    $reddit = $result->fetch_assoc();

    return $reddit;
};
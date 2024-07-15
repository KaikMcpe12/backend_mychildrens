<?php
require_once '../connect.php';

function register_user($name, $email, $password){
    GLOBAL $conn;

    $stmt = $conn->prepare("INSERT INTO user(id_user, name, email, password, url_image)  VALUES (?, ?, ?, ?, ?);");
    $stmt->bind_param('issss', $id_user, $name, $email, $password, $url_image);

    $url_image = random_int(0,8);
    $id_user = random_int(1,10**9);
    $password = password_hash($password, PASSWORD_DEFAULT);
    if($stmt->execute()){
        return true;
    }else{
        return false;
    };
};

function verify_email($email){
    GLOBAL $conn;

    $sql = "SELECT email FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    $compare_email = $result->fetch_assoc();

    if($email == $compare_email){
        return true;
    }else{
        return false;
    };
};
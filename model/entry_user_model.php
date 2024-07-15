<?php
require_once '../connect.php';

function verify_user($email, $password){
    GLOBAL $conn;

    $result = $conn->query("SELECT id_user, password FROM user WHERE email = '$email'");

    $res = $result->fetch_assoc();

    if(password_verify($password, $res['password'])){
        return $res['id_user'];
    }else{
        return false;
    };
};
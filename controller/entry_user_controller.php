<?php
require_once '../model/entry_user_model.php';

function clear($input){
    GLOBAL $conn;

    $var = $conn->escape_string($input);
    $var = htmlspecialchars($var);

    return $var;
};

$email = clear($_POST['email']);
$password = clear($_POST['password']);

$id_user = verify_user($email, $password);
if($id_user){
    session_start();
    $_SESSION['id_user'] = $id_user;
    echo "<script>alert('Entrada com sucesso'); window.location.href='../index.php';</script>";
}else{
    echo "<script>alert('Email ou seha invalidos'); window.location.href='../entry.php';</script>";
};

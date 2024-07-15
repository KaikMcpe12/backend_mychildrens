<?php
require_once '../model/register_user_model.php';

function clear($input){
    GLOBAL $conn;

    $var = $conn->escape_string($input);
    $var = htmlspecialchars($var);

    return $var;
};

$name = clear($_POST['name']);
$email = clear($_POST['email']);
$password = clear($_POST['password']);

if(verify_email($email)){
    echo "<script>alert('Email existente!'); window.location.href='../register.php';</script>";
}else if(register_user($name, $email, $password)){
    echo "<script>alert('Cadastrado com sucesso!'); window.location.href='../entry.php';</script>";
};
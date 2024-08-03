<?php
$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$username = '';
$length = 8;
for ($i = 0; $i < $length; $i++) {
    $username .= $characters[rand(0, strlen($characters) - 1)];
}

$password = '';
$passwordLength = 8;
$passwordCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#';
for ($i = 0; $i < $passwordLength; $i++) {
    $password .= $passwordCharacters[rand(0, strlen($passwordCharacters) - 1)];
}

<?php

$fs   = true;
$data = $argv[1] ?? '';
while (empty($data)) {
    if ($fs) {
        fwrite(STDOUT, 'please enter the data: ');
        $fs = false;
    } else {
        fwrite(STDOUT, 'sorry! the data can not empty, please reenter: ');
    }
    $data = trim(fgets(STDIN));
}

$source      = base64_decode(urldecode($data));
$cipher_algo = 'AES-256-CBC';
$cipher_key  = 'e8b7b40e031300000000da247441226a';
$cipher_iv   = substr($source, 0, $iv_length = openssl_cipher_iv_length($cipher_algo));
$cipher_text = substr($source, $iv_length);
$plain__text = openssl_decrypt($cipher_text, $cipher_algo, $cipher_key, 0, $cipher_iv);
$result      = json_decode($plain__text, true);
var_dump($plain__text, $cipher_text, $result);

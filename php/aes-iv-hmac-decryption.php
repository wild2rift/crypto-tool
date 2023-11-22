<?php
// MDVjMTFmNmMyNDdiNjZkYWE2MTg3MzY3ZDFhNGY5Y2EwZjk0MzU1MDRjODJjMmEwNWY5MWZiYzI5YmVlMGRhZmI3NmUzNTczZWQyZjkwMDNhQ1QwRUErQm41L0p1RjhXQXdodjZ5QXlaMXNGQjAvSWNKQ1FJdjU3UWkrN2l5Ni9NUmpoSlhBcG9aV1A2dHF3cUY5eTdOS2djQlRJRzZ4TVhMTVZEc0NCYThFOWw0QUk2SDBXRjhOZE4vbXdvTzNycGoycC9HbzVFR1JaZy9qSTN6Y2N3WEtzWmY5S3pFbFRmV3Y3bGdzemVJUnVaTTJQY3ZuNHpyTGFRbFgwanJ4Sjc0TlRZSG5MVGdFUE91T280M2JMK085TGE1S2V3eUpBZDJ5WTRqSFZjZm5XS0lmcnJLN3BMamdybDd4SEh4MVpub0hNS2pWNkxmcm9aNExZY0ordHprVWN3UWRmUGJ4dk5VeStqOG1sMWdqaU1QVHR1eTBONDF6N0dXST0%3D
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
$cipher_hmac = substr($source, $iv_length, $hmac_length = 64);
$cipher_text = substr($source, $iv_length + $hmac_length);
$plain__text = openssl_decrypt($cipher_text, $cipher_algo, $cipher_key, 0, $cipher_iv);
$calc_hmac   = hash_hmac('sha256', $cipher_text, $cipher_key);
!hash_equals($cipher_hmac, $calc_hmac) && throw new \Error('The data is invalid');
$result = json_decode($plain__text, true);
var_dump($plain__text, $cipher_text, $result);

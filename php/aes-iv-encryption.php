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

$source      = json_encode(json_decode($data, true), JSON_UNESCAPED_UNICODE);
$cipher_algo = 'AES-256-CBC';
$cipher_key  = 'e8b7b40e031300000000da247441226a';
$cipher_iv   = bin2hex(openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_algo) / 2));
$plain__text = $source;
$cipher_text = openssl_encrypt($plain__text, $cipher_algo, $cipher_key, 0, $cipher_iv);
$result      = urlencode(base64_encode(sprintf('%s%s', $cipher_iv, $cipher_text)));
var_dump($plain__text, $cipher_text, $result);

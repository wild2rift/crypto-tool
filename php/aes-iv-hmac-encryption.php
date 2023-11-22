<?php
// {"provider":"ALIPAY","transaction_id":"ALIPAY_HK71533387bf246231637d597c611a889q","subscription_id":"UBNpi1iis0de9DZtJp+Aq1FJNlRYOGRHbnprWkZlMjFFRm1FRGc9PQ==","user_id":"500000402","area_id":"1","lang_id":"1"}
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
$cipher_hmac = hash_hmac('sha256', $cipher_text, $cipher_key);
$result      = urlencode(base64_encode(sprintf('%s%s%s', $cipher_iv, $cipher_hmac, $cipher_text)));
var_dump($plain__text, $cipher_text, $result);

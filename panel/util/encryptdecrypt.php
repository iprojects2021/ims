<?php
// crypto_functions.php

function encrypt($plaintext, $key) {
    $cipher = "AES-256-CBC";
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, 0, $iv);
    return base64_encode($iv . $ciphertext);
}

function decrypt($ciphertext_base64, $key) {
    $cipher = "AES-256-CBC";
    $ciphertext_dec = base64_decode($ciphertext_base64);
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($ciphertext_dec, 0, $iv_length);
    $ciphertext = substr($ciphertext_dec, $iv_length);
    return openssl_decrypt($ciphertext, $cipher, $key, 0, $iv);
}

<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

// 密码加密
if (!function_exists('str2Encrypt')) {

    function str2Encrypt(string $str, $salt = '')
    {
        return sha1(md5(sha1($str) . $salt));
    }
}

// 加密
if (!function_exists('encrypt')) {

    function encrypt($data, $key = 'Eawkls8in1e')
    {
        $plaintext = serialize($data);  // 序列化加密数据
        $cipher = 'AES-128-CBC';        // 加密方法
        $options = OPENSSL_RAW_DATA;
        $as_binary = true;              // 输出原始的二进制数据
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary);
        $ciphertext = base64_encode($iv.$hmac.$ciphertext_raw);
        return $ciphertext;
    }
}

// 解密
if (!function_exists('decrypt')) {

    function decrypt(string $str, $key = 'Eawkls8in1e')
    {
        $cipher     = "AES-128-CBC"; // 加密方法
        $sha2len    = 32;
        $options    = OPENSSL_RAW_DATA;
        $as_binary  = true;
        $str = base64_decode($str);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($str, 0, $ivlen);
        $hmac = substr($str, $ivlen, $sha2len);
        $ciphertext_raw = substr($str, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary);
        if (hash_equals($hmac, $calcmac)) {
            return unserialize($original_plaintext);
        }
        return false;
    }
}

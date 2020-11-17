<?php

// AUTHER :  ARVIND KUAMR SINGH
// DATED  :  29-11-2019

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('CI')) {

    function CI() {
        $CI = & get_instance();
        return $CI;
    }

}

// WARI PAYMENT VERIFY USER 

function W_userVerify($W_USER, $W_PASS) {

    $url = 'https://wariglobalpay.com/testpayementws/auth/' . $W_USER . '/' . $W_PASS . '/en';
    $headers = array();
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($handle);
    $suc = json_decode($response);

    if ($suc->statusCode == 000) {
        return $suc->statusMessage;
    } else {
        return FALSE;
    }
}

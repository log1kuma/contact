<?php

namespace MyApp\Services;

class FormValidator extends Validator {
    public static $token;
    
     static function setToken()
    {
        if (!isset(self::$token)) {
            self::$token = sha1(uniqid(mt_rand(), true));
            //sha1(おまじない)
            $_SESSION['token'] = self::$token;
        }
        
        return $_SESSION['token'];
    }
    //staticなクラスは変数が保持されないため、$_SESSIONに保存する

    function checkToken()
    {
        if ($_POST['token'] !== $_SESSION['token']) {
            //送信者が送ったトークン !== 保存されていたトークン
            echo '不正な処理です' . PHP_EOL;
            exit();
        }
    }
    
}
<?php

    namespace MyApp\Services;
    use MyApp\Services\DatabaseModel;
    require_once 'DatabaseModel.php';
    
    $contacts = new DatabaseModel();
    //違うphpファイルなのでインスタンス作っていいよ！
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ここで$_POSTをデータベースに登録する
        $contacts->insert();
    }
    
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        header('Location: ' . 'thanks.php');
    }
    //var_dump($_SERVER['REQUEST_METHOD']);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせフォーム</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="support_form">
            <p>お問い合わせが送信されました。</p>
            <p>ありがとうございました！</p>
            <div class="button"><a href="contact.php">トップに戻る</a></div>
        </div>
    </body>
</html>
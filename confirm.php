<?php

    require_once 'Validator.php';
    require_once 'FormValidator.php';
    use MyApp\Services\FormValidator;
    
    session_start();

    //checkToken();
    /*
    $errors = [];
    $contact = $_POST;
    var_dump($contact);
    */
    var_dump($_POST);
    $validator = new FormValidator;
    $validator->validate($_POST, [
        'email' => ['required', 'email'],
        'content' => ['required']
    ]);
    $validator->checkToken();
    
    //1. hasErrorメソッドが存在しない
    //2. getErrorsメソッドが存在しない
    if($validator->hasError()){
        //ここで結果が正しく表示されていればOK
        var_dump($validator->getErrors());
        $_SESSION['inputs'] = $_POST;
        $_SESSION['errors'] = $validator->getErrors();
        header('Location: ' . 'index.php', true, 302);
    }
    
    //hasError:配列の情報を見にいく。エラーがあるかどうかをboolen型ででreturn
    //getErrors:エラー情報を配列形式でreturn
        
    // $pattern = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
    // if (preg_match($pattern, $email)) {
    //     $errors['email'] = 'メールアドレスの形式が不正です。';
    // }
    /*
    if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスの形式が不正です。';
    }
    if (empty($contact['email'])) { // null, '', 0
        $errors['email'] = 'メールアドレスは必須項目です。';
    }
    if (empty($contact['content'])) {
        $errors['content'] = '内容は必須項目です。';
    }
    
    var_dump($errors);
    */
    
    /*
    if (count($errors) > 0) {
        //送信完了した時点で、POSTの中身は消える。全てが空になるので、エラーになる。
        $_SESSION['inputs'] = $_POST;
        $_SESSION['errors'] = $errors;
        //前のページに戻る前に、$_SESSIONにデータを入れる必要がある
        header('Location: ' . index.php, true, 302);
        //302はステータスコード：ページを一時的に遷移させたい時に使う
        //エラーが一件でもある場合、指定のURLに戻る（情報は保持される）
        //$_SERVER['HTTP_REFERER']リファラ：どのページから流入して来たのかを知るための情報
    }
    */
    
    /*
    function checkToken()
    {
        if ($_POST['token'] !== $_SESSION['token']) {
            //送信者が送ったトークン !== 保存されていたトークン
            echo '不正な処理です' . PHP_EOL;
            exit();
        }
    }
    */

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせフォーム</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="thanks.php" method="POST">
            <table>
                <tr>
                    <td class="label_title"><label for="name">メールアドレス</label></td>
                    <td>
                        <?php print $_POST['email']; ?>
                        <input type="hidden" name="email" value="<?php print $_POST['email']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label_title"><label for="content">お問い合わせ内容</label></td>
                    <td>
                        <?php print $_POST['content']; ?>
                        <input type="hidden" name="content" value="<?php print $_POST['content']; ?>" />
                    </td>
                </tr>
            </table>
            <p>以上の内容を送信しますか？</p>
            <div class="button"><a href="index.php">トップに戻る</a></div>
            <input type="submit" value="送信する" class="button">
        </form>
    </body>
</html>
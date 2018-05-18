<?php 

    require_once 'Validator.php';
    require_once 'FormValidator.php';
    use MyApp\Services\FormValidator;

    define('PAGE_TITLE', 'お問い合わせフォーム');
    session_start();
    //session_unset();
    
    var_dump($_SESSION['inputs']);
    var_dump($_SESSION['errors']);
    var_dump($_SERVER['REQUEST_METHOD']);
        
    if($_SESSION['errors']){
        print "エラーがあるよ" . PHP_EOL;
        $errors = $_SESSION['errors'];
        $inputs = $_SESSION['inputs'];
        var_dump($errors);
    //情報を入力するのがだるいから
    }

    //$validator->setToken();
    
    /*
    function setToken()
    {
        if (!isset($_SESSION['token'])) {
            $_SESSION['token'] = sha1(uniqid(mt_rand(), true));
            //sha1(おまじない)
        }
        var_dump($_SESSION['token']);
    }
    */
    
?>

<!DOCTYPE html>
<html lang="ja">
<?php require_once('./head.php'); ?>
<body>
<div>
    <div class="support_form">
        <div><h1><?php echo PAGE_TITLE; ?></h1></div>
        <form action="confirm.php" method="POST">
            <input type="hidden" name="token" value="<?php print FormValidator::setToken(); ?>">
            <?-- こっそりトークンをinputする -->
            <table>
                <tr>
                    <td class="label_title"><label for="email">メールアドレス</label></td>
                    <td><div class="warning">必須</div></td>
                    <td>
                        <input type="text" name="email" value="<?php echo $inputs['email']; ?>" >
                        <?php if ($errors['email']) { ?>
                            <p style="color: red;">
                                <?php 
                                    if($errors['email']['required']){
                                        echo $errors['email']['required'] , PHP_EOL;
                                    }else{
                                        echo $errors['email']['email'] , PHP_EOL;
                                    }
                                ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td class="label_title"><label for="content">お問い合わせ内容</label></td>
                    <td><div class="warning">必須</div></td>
                    <td>
                        <textarea
                        name="content"
                        rows="10"
                        cols="60"
                        placeholder="ここに入力してください"><?php echo $inputs['content']; ?></textarea>
                        <?php if ($errors['content']) { ?>
                            <p style="color: red;"><?php echo $errors['content']['required']; ?></p>
                        <?php } ?>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="送信する" class="button"></td>
                </tr>
                
            </table>
        </form>
    </div>
</div>
</body>
</html>
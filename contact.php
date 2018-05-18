<?php
    namespace MyApp\Services;
    use MyApp\Services\DatabaseModel;
    require_once 'DatabaseModel.php';
    //require_once 'thanks.php';
    
    //$databaseModel = new DatabaseModel();
    $contacts = new DatabaseModel();
    
    $records = $contacts->read();
    
    if($_POST['method'] == "delete"){
        $contacts->delete();
        $records = $contacts->read();
    }elseif($_POST['method'] == "search"){
        $records = $contacts->search();
    }
    
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせ一覧</title>
    </head>
    <body>
        <a href="contact.php"><h1>お問い合わせ一覧</h1></a>
        <a href="index.php">お問い合わせフォームへ</a>
        <form action="contact.php" method="POST">
            <input type="hidden" name="method" value="search">
            <input type="text" name="word" placeholder="検索したいお問い合わせ内容" required>
            <input type="submit" value="検索">
        </form>
        <ul>
        <?php
            if($records){
                foreach ($records as $record) {
                    // $recoads[1], $re:cords[2], $records[3]…が$recordに格納される
                    $id = $record['id'];
                    $email = $record['email'];
                    $context = $record['context'];
                    $created_at = new \DateTime($record['created_at']);
                    
                    //↓こっちの方がデザイナーさんとか手を入れやすい
                    //"$book_title だよ"みたいにすれば文字列連結しなくてもかけるよ
                    //ただし配列はかっこで囲まないとダメ
                    
        ?>
                <li><?php print "$id / " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . " / " . $created_at->format('Y-m-d'); ?>
                <br><?php print htmlspecialchars($context, ENT_QUOTES, 'UTF-8');?>
                <form action="contact.php" method = "POST">
                    <input type="hidden" name="method" value = "delete">
                    <input type="hidden" name="delete_content_id" value = <?php print $id; ?>>
                    <input type ="submit" name="delete_content" value="削除">
                </form>
                </li>
        <?php    
                }
            }
        ?>
        </ul>
    </body>
</html>
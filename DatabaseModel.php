<?php

namespace MyApp\Services;
 
class DatabaseModel {
    //MySQLをいじるためのプロパティ
    protected $username = 'root';
    protected $password = '';
    private $database = null;

    //データベースを起動する
    public function __construct(){
        $this->database = new \PDO('mysql:host=localhost;dbname=contacts;charset=UTF8;', $this->username, $this->password);
    }

    //データベースに登録するメソッド
    public function insert(){
        $sql = 'INSERT INTO contact (email, context) VALUES (:email, :content)';
        $statement = $this->database->prepare($sql);
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':content', $_POST['content']);
        $statement->execute();
        
        $statement = null;
        
        $database = null;
    }
    
    //SQLを実行して配列に格納するメソッド
    public function read(){
        if(){
            $sql = 'SELECT * FROM contact WHERE context LIKE :word ORDER BY created_at DESC';
            $word = '%' . $_POST['word'] . '%';
        }else{
            $sql = 'SELECT * FROM contact ORDER BY created_at DESC';
        }
        //SQLを実行
        $statement = $this->database->query($sql);
        //結果レコードを配列に変換
        $records = $statement->fetchAll();
    
        $statement = null;
        //処理が終わったら接続を切断
        $database = null;
        
        return $records;
    }
    
    //削除するメソッド
    public function delete(){
        $sql = 'DELETE FROM contact WHERE id = :delete_content_id';
        $statement = $this->database->prepare($sql);
        $statement->bindParam(':delete_content_id', $_POST['delete_content_id']);
        $statement->execute();
        $statement = null;  
    }
    
    //検索するメソッド
    public function search(){
        $sql = 'SELECT * FROM contact WHERE context LIKE :word ORDER BY created_at DESC';
        $statement = $this->database->prepare($sql);
        $word = '%' . $_POST['word'] . '%';
        $statement->bindParam(':word', $word);
        $statement->execute();
        $records = $statement->fetchAll();
        $statement = null;
        $this->database = null;
        
        return $records;
    }
    
    
    
}
?>
<?php
namespace MyApp\Services;

class Validator {
    protected $errors = [];
    protected $translations = [
        'email' => 'メールアドレス',
        'content' => 'お問い合わせ内容',
    ];
    
    public function validate($data, $validations)
    {
        foreach ($validations as $field => $validationMethods) {
            foreach ($validationMethods as $method) {
                var_dump($method);
                $this->$method($data, $field);
                //$this->require($_POST, 'email')
                //$this->email($_POST, 'email')
                //$this->require($_POST, 'content')
            }
        }
        
    }
    
 
    private function required($data, $field)
    {
        if (empty($data[$field])) {
            $fieldLabel = $this->translations[$field];
            $this->errors[$field]['required'] = "{$fieldLabel}は必須項目です。";
        }
    }
    //メアド、内容が空だったらエラー配列に格納
    
    private function email($data, $field)
    {
        if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
            $fieldLabel = $this->translations[$field];
            $this->errors[$field]['email'] = "{$fieldLabel}の形式が不正です。";
        }
    }
    //メアドの形式がおかしかったらエラー配列に格納
    
    public function getErrors(){
        return $this->errors;
    }
    
    public function hasError(){
        return count($this->errors) > 0;
        //returnは条件式でも返すことができる。boolen型で返す時に便利。
        // return !empty($this->errors); でもOK
    }

}
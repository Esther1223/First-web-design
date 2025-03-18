<?php
    class Database{
        //取得資料庫連線
        public function getConnection(){
            $connect = new PDO("mysql:host=localhost;port=3306;dbname=school_db","root","");
            return $connect;
        }
    }
?>
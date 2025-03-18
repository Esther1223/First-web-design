<?php
    class Department{
        // 一、屬性
        public $dbConnect;
        // 二、建構式
        public function __construct(){
            // 建立真實的資料庫連線物件
            $db = new Database();
            // 取得資料庫連線物件 設定給dbConnect屬性
            $this->dbConnect = $db->getConnection();
        }
        // 三、方法:讀取department表格的department_code欄位
        public function getCode(){
            $sql = "SELECT department_code FROM department";
            $getCode = $this->dbConnect->prepare($sql);
            $getCode->execute();
            $data = $getCode->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
?>
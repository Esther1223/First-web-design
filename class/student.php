<?php
    class Student{
        /*屬性*/
        //資料庫連線
        public $dbConnect;
        //欄位資料
        public $id;
        public $stdName;
        public $stdID;
        public $departmentCode;

        /*自動執行建構式*/
        public function __construct(){
            //取得資料庫連線
            $db = new Database();
            $this->dbConnect = $db->getConnection();
        }

        /*方法:CRUD*/
        //Create
        public function create(){
            $sql = "INSERT INTO student(std_name,std_id,department_code) 
                    VALUES(:std_name,:std_id,:department_code)";
            $createData = $this->dbConnect->prepare($sql);
            $createData->bindParam(":std_name",$this->stdName);
            $createData->bindParam(":std_id",$this->stdID);
            $createData->bindParam(":department_code",$this->departmentCode);
            
            $result = $createData->execute(); //回傳布林值
            return $result;
        }

        //Read
        public function getAllStd(){
            $sql = "SELECT * FROM student";
            $getData = $this->dbConnect->prepare($sql);
            $getData->execute();
            $data = $getData->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        //Update
        //取得單筆資料
        public function getOneStd(){
            $sql = "SELECT * FROM student WHERE id = :id";
            $getOneStd = $this->dbConnect->prepare($sql);
            $getOneStd->bindParam(":id",$this->id);
            $getOneStd->execute();
            $data = $getOneStd->fetch(PDO::FETCH_ASSOC);
            //回傳到表單上面
            $this->stdName = $data["std_name"];
            $this->stdID = $data["std_id"];
            $this->departmentCode = $data["department_code"];
        }
        //更新資料
        public function update(){
            $sql = "UPDATE student 
                SET std_name = :std_name,
                    std_id = :std_id,
                    department_code = :department_code 
                WHERE id = :id";
            $updateData = $this->dbConnect->prepare($sql);
            $updateData->bindParam(":std_name",$this->stdName);
            $updateData->bindParam(":std_id",$this->stdID);
            $updateData->bindParam(":department_code",$this->departmentCode);
            $updateData->bindParam(":id",$this->id);

            $result = $updateData->execute();
            return $result;
        }

        //Delete
        public function delete(){
            $sql = "DELETE FROM student WHERE id = :id";
            $deleteData = $this->dbConnect->prepare($sql);
            $deleteData->bindParam(":id",$this->id);
            $result = $deleteData->execute();
            return $result;
        }
    }
?>
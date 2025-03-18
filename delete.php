<?php
    include "./class/database.php";
    include "./class/student.php";
    $student = new Student();
    $student->id = $_GET["id"];
    
    if($student->delete()){
        echo 1;
    }
    else{
        echo 0;
    }
?>
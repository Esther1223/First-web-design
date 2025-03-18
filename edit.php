<?php
    include "./layout/header.php";
    include "./class/student.php";
    include "./class/department.php";
    include "./class/database.php";
    $department = new Department();
    $student = new Student();
    //取得該筆資料
    $student->id = $_GET["id"];
    $student->getOneStd();
    //取得所有系所資料
    $data = $department->getCode();
    //如果有送出表單
    if(isset($_POST["submit"])){
        //取得表單資料
        $student->stdName = $_POST["std-name"];
        $student->stdID = $_POST["std-id"];
        $student->departmentCode = $_POST["department-code"];
    }
?>
<!-- 表單元件 -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <!-- 表單 -->
            <form action="edit.php?id=<?= $_GET['id']?>" method="post">
                <!-- 學生名 -->
                <div class="form-group">
                    <label for="std-name">學生名</label>
                    <input type="text" class="form-control" name="std-name" id="std-name" required value="<?= $student->stdName?>">
                </div>
                <!-- 學號 -->
                <div class="form-group">
                    <label for="std-id">學號</label>
                    <input type="text" class="form-control" name="std-id" id="std-id" required value="<?= $student->stdID?>">
                </div>
                <!-- 系所代碼 -->
                <div class="form-group">
                    <label for="department-code">系所代碼</label>
                    <select class="form-control" name="department-code" id="department-code" required>
                        <?php foreach($data as $row):?>
                            <?php if($row["department_code"] === $student->departmentCode):?> 
                                <option value="<?= $row["department_code"] ?>" selected>
                                    <?= $row["department_code"] ?>
                                </option>
                            <?php else:?>
                                <option value="<?= $row["department_code"] ?>">
                                    <?= $row["department_code"] ?>
                                </option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                </div>
                <!-- 送出按鈕 -->
                <button type="submit" name="submit" class="btn btn-info">送出</button>
                <a href="./index.php" class="btn btn-outline-secondary">回首頁</a>
            </form>
            <?php
                if(isset($_POST["submit"])){
                    //更新資料
                    if($student->update()){
                        echo '<div class="alert alert-warning my-3" role="alert">
                              更新成功
                              </div>';
                    }else{
                        echo '<div class="alert alert-warning my-3" role="alert">
                              稍後在試
                              </div>';
                    }
                }
            ?>
        </div>
    </div>
</div>
<?php include "./layout/footer.php";?>
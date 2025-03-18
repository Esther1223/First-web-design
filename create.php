<?php
    include "./layout/header.php";
    include "./class/student.php";
    include "./class/department.php";
    include "./class/database.php";
    $department = new Department();
    //取得所有國家資料
    $data = $department->getCode();
    //var_dump($data);
    //建立城市物件
    $student = new Student();
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <!-- 表單 -->
            <form action="create.php" method="post">
                <!-- 學生名 -->
                <div class="form-group">
                    <label for="std-name">學生名</label>
                    <input type="text" class="form-control" name="std-name" id="std-name" required>
                </div>
                <!-- 學號 -->
                <div class="form-group">
                    <label for="std-id">學號</label>
                    <input type="text" class="form-control" name="std-id" id="std-id" required>
                </div>
                <!-- 系所代碼 -->
                <div class="form-group">
                    <label for="department-code">系所代碼</label>
                    <select class="form-control" name="department-code" id="department-code" required>
                        <?php foreach($data as $row):?>
                            <option value="<?= $row["department_code"] ?>">
                                <?= $row["department_code"] ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <!-- 送出按鈕 -->
                <button type="submit" name="submit" class="btn btn-info">送出</button>
                <a href="./index.php" class="btn btn-outline-secondary">回首頁</a>
            </form>
            <!-- 送出表單的語法 -->
            <?php
                if(isset($_POST["submit"])){
                    //取得表單資料
                    $student->stdName = $_POST["std-name"];
                    $student->stdID = $_POST["std-id"];
                    $student->departmentCode = $_POST["department-code"];
                    //新增城市資料
                    if($student->create()){
                        echo '<div class="alert alert-warning my-3" role="alert">
                              新增成功
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

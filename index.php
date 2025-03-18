<?php
    include "./layout/header.php";
    include "./class/student.php";
    include "./class/database.php";

    //新增城市物件
    $student = new Student();
    //取得所有城市資料
    $data = $student->getAllStd();
?>
<body>
    <!-- Bootstrap Container -->
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <!-- 表格 -->
                <table id="student-table" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">學生名字</th>
                            <th scope="col">學生學號</th>
                            <th scope="col">學生系所</th>
                            <th scope="col">編輯/刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row):?>
                            <tr>
                                <td><?= $row["id"] ?></td>
                                <td><?= $row["std_name"] ?></td>
                                <td><?= $row["std_id"] ?></td>
                                <td><?= $row["department_code"] ?></td>
                                <td>
                                    <a href="./edit.php?id=<?= $row["id"] ?>" class="btn btn-outline-info">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-outline-secondart delete-btn" delete-id="<?= $row["id"] ?>">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "./layout/footer.php"; ?>
    <script>
        $(document).ready(function() {
            //套用dataTable
            $('#student-table').DataTable();
            //刪除按鈕 用AJAX送出請求
            $("#student-table").on("click",".delete-btn",function(){
                //取得刪除的id
                $id = $(this).attr("delete-id");
                var confirmResult = confirm("確定要刪除嗎?");
                if(confirmResult){
                    //AJAX
                    $.ajax({
                        url:"delete.php",
                        type:"GET",
                        data:{id:$id},
                        success:function(data){
                            if(data == 1){
                                alert("刪除成功!");
                                location.reload();
                            }
                            else{
                                alert("刪除失敗!");
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
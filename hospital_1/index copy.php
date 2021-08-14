<?php
require_once "database.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css">

</head>
    <title>找醫院</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link">資料列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.html">新增資料</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="login.php">登入</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">註冊</a>
            </li>
        </ul>
    </div>
</nav>

<!-- <img src="./banner-bg-hospital.jpg" class="img-fluid" alt="..."> -->

    <div class="info text-center">
        <h1>醫院資訊</h1>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination  d-flex justify-content-end">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">院所名稱</th>
                <th scope="col">看診科別</th>
                <th scope="col">醫師姓名</th>
                <th scope="col">看診時段</th>
                <th scope="col">電話</th>
                <th scope="col">地址</th>
                <th scope="col">操作</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            //查詢所有數據的sql語句
            $sql = "SELECT * FROM `hospital`";
            //執行sql語句
            $result = $pdo->query($sql);
            ?>
            <?php
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                //var_dump($row)   
            ?>
            <tr>
                <td><?php echo $row["院所名稱"];?></td>
                <td><?php echo $row["看診科別"];?></td>
                <td><?php echo $row["醫師姓名"];?></td>
                <td><?php echo $row["看診時段"];?></td>
                <td><?php echo $row["電話"];?></td>
                <td><?php echo $row["地址"];?></td>
                <td>
                    <i class="fas fa-edit"></i>
                    <a href="edit.php?id=<?php echo $row['sid']?>">編輯</a>
                    <i class="fas fa-trash-alt"></i>
                    <a href="del.php?id=<?php echo $row['sid']?>" href="" onclick="javascript:return del();">刪除</a>
                </td>
                

            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <script>
    function del() {
        var msg = "是否刪除此筆資料？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }



</script>


</body>
</html>
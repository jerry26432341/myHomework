<?php
require_once "database.php"
?>

<?php
// 固定每一頁最多幾筆
$perPage = 20;

// 用戶決定查看第幾頁，預設值為 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 總共有幾筆
$totalRows = $pdo->query("SELECT count(1) FROM hospital ")
->fetch(PDO::FETCH_NUM)[0];

// 總共有幾頁, 才能生出分頁按鈕
$totalPages = ceil($totalRows / $perPage); // 正數是無條件進位

// echo "$totalRows, $totalRows/$perPage)";

$sql = sprintf("SELECT * FROM hospital ORDER BY sid DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );


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



    <div class="info text-center">
        <!-- <h1>醫院資訊</h1> -->
        <img src="./bg.png" class="img-fluid" alt="...">
    </div>

    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-end">

                    <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php
                        $qs['page']=$page-1;
                        echo http_build_query($qs);
                        ?>">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>
                    </li>

                    <?php for($i=$page-5; $i<=$page+5; $i++):
                        if($i>=1 and $i<=$totalPages):
                            $qs['page'] = $i;
                            ?>
                    <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query($qs) ?>"><?= $i ?></a>
                    </li>
                    <?php endif;
                        endfor; ?>

                    <li class="page-item <?= $page>=$totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php
                        $qs['page']=$page+1;
                        echo http_build_query($qs);
                        ?>">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>







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
            // $sql = "SELECT * FROM `hospital`";
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
                    <a href="edit.php?id=<?php echo $row['sid']?>" class="fas fa-edit">編輯</a>
                    <a href="del.php?id=<?php echo $row['sid']?>" class="fas fa-trash-alt" href="" onclick="javascript:return del();">刪除</a>
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
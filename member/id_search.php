<?php
$search_id = $_POST["search_id"];

include "../inc/dbcon.php";

$sql = "select uid from members where uid ='$search_id';";

$result = mysqli_query($dbcon,$sql);
$rows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>"<?php echo $search_id ?>"검색결과</title>
    <style type="text/css">
    body{font-size:20px}
    .t{color:#e89c21}
    .y{color:#4c8aed;font-weight:bold}
    .n{color:#ff4500;font-weight:bold}
    </style>
    <?php if(!$rows){ ?>
    <script type="text/javascript">
        function return_id(){
            opener.document.getElementById("uid").value = "<?php echo $search_id ?>";
            window.close();
        }
    </script>
    <?php } ?>
</head>
<body>
    <?php if(!$rows){ ?>

    <span class="t">"<?php echo $search_id ?>"</span>은/는 <span class="y">사용 가능한 </span>아이디 입니다.
    <a href="#" onclick="return_id()">[사용하기]</a>

    <?php }else{ ?>

    <span class="t">"<?php echo $search_id ?>"</span>은/는 <span class="n">사용 할 수 없는</span> 아이디 입니다.
    <a href="javascript:history.back()">[돌아가기]</a>

    <?php } ?>
</body>
</html>
<?php
mysqli_close($dbcon);
?>
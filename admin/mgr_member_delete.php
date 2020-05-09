<?php
    session_start();
    $sid = $_SESSION["uid"]? $_SESSION["uid"]:"";

    $idx = $_GET["idx"];

    $sql = "delete from members where idx =$idx;";
    
    include "../inc/dbcon.php";

    mysqli_query($dbcon,$sql);

    mysqli_close($dbcon);

    echo "<script type='text/javascript'>
    alert('삭제가 완료되었습니다.');
    location.href='mgr_member.php';
    </script>";
?>

<?php
    session_start();
    $sid = $_SESSION["uid"]? $_SESSION["uid"]:"";

    $sql = "delete from members where uid ='$sid';";
    
    include "../inc/dbcon.php";

    mysqli_query($dbcon,$sql);

    mysqli_close($dbcon);

    unset($_SESSION["uid"]);

    echo "<script type='text/javascript'>
    alert('탈퇴가 완료되었습니다.');
    location.href='../index.php';
    </script>";
?>

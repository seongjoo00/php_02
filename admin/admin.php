<?php
    session_start();
    $sid = $_SESSION["uid"]? $_SESSION["uid"]:"";

    if($sid != "admin" || !$sid){
        echo "<script type='text/javascript'>
        alert('관리자만 사용할 수 있습니다.');
        location.href='../admin/login.php';
        </script>";
    };
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>관리자 페이지</title>
</head>
<body>
    <h2>* 관리자 페이지 *</h2>
    <p>
    <a href="#">게시판 관리</a>
    </p>

    <p>    
    <a href="mgr_member.php">회원 관리</a>
    </p>
</body>
</html>
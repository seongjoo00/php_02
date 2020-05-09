<?php
    session_start();
    $sid = $_SESSION["uid"]? $_SESSION["uid"]:"";

    $pwd = $_POST["pwd"];
    $birthday = $_POST["birthday"];
    $mobile = $_POST["mobile"];
    $email_id = $_POST["email_id"];
    $email_dns = $_POST["email_dns"];
    $email = $email_id."@".$email_dns;
    $gender = $_POST["gender"];

    include "../inc/dbcon.php";
    if(!$pwd){
    $sql = "update members set birthday='$birthday',mobile='$mobile',email='$email',gender='$gender' where uid='$uid';";
    }else{
    $sql = "update members set pwd='$pwd',birthday='$birthday',mobile='$mobile',email='$email',gender='$gender' where uid='$uid';";
    };

    mysqli_query($dbcon,$sql);
    
    mysqli_close($dbcon);

    echo "<script type='text/javascript'>
    alert('정보수정이 완료되었습니다.');
    location.href='../index.php';
</script>";
?>

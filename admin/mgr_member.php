<?php
    $sql = "select * from members;";
    
    include "../inc/dbcon.php";
    $result = mysqli_query($dbcon,$sql);

    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>회원관리</title>
    <style type="text/css">
        table,td{border:1px solid #000}
    </style>
    <script type="text/javascript">
        function del_id(idx){
            var n = confirm('회원을 삭제 하시겠습니까?');
            if(n){
                location.href="mgr_member_delete.php?idx="+idx;
            };
        };
    </script>
</head>
<body>
    <h2>회원 목록</h2>
    <table>
    <tr>
        <td>번호</td>
        <td>이름</td>
        <td>아이디</td>
        <td>생년월일</td>
        <td>휴대폰번호</td>
        <td>이메일</td>
        <td>성별</td>
        <td>가입일자</td>
        <td>수정</td>
        <td>삭제</td>
    </tr>
    <?php
    $begin_num = 1;
    while($array = mysqli_fetch_array($result)){
    ?>
    <tr>
    <td><?php echo $array["idx"]; ?></td>
    <td><?php echo $array["uname"]; ?></td>
    <td><?php echo $array["uid"]; ?></td>
    <td><?php echo $array["birthday"]; ?></td>
    <td><?php echo $array["mobile"]; ?></td>
    <td><?php echo $array["email"]; ?></td>
    <?php 
    if($array["gender"] == "M"){ 
        $gender = "남";
    }else{
        $gender="여";
    }
    ?>
    <td><?php echo $gender ?></td>
    <td><?php echo $array["reg_date"]; ?></td>
    <td><a href="mgr_member_edit.php?idx=<?php echo $array["idx"]; ?>">수정</a></td>
    <td><a href="#" onclick="del_id(<?php echo $array["idx"]; ?>)">삭제</a></td>
    </tr>
    
    <?php $begin_num++;} ?>
    
    </table>
</body>
</html>
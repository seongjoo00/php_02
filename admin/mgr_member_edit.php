<?php
    session_start();
    $sid = $_SESSION["uid"]? $_SESSION["uid"]:"";

    $idx = $_GET["idx"];

    if(!$sid){
        echo "<script type='text/javascript'>
        alert('로그인 사용자만 사용가능합니다.');
        history.back();
        </script>";
    };
    include "../inc/dbcon.php";
    $sql = "select * from members where idx = $idx;";
    $result = mysqli_query($dbcon,$sql);
    $array = mysqli_fetch_array($result);

    $birth = explode("-",$array["birthday"]);
    $email = explode("@",$array["email"]);
    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>정보수정</title>
    <script type="text/javascript">
    function form_check(frm){
        var uname =document.getElementById("uname");
        var uid =document.getElementById("uid");
        var pwd =document.getElementById("pwd");
        var repwd =document.getElementById("repwd");
        var birthday =document.getElementById("birthday");
        var mobile =document.getElementById("mobile");
        var email_id =document.getElementById("email_id");
        var male =document.getElementById("male");
        var female =document.getElementById("female");
        var reg_spc = /[`~!@#$%^&*|\\\'\";:\/?]/;
        var reg_num = /[0-9]/;
        var reg_kor = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
        

        /* pwd */
        if(pwd.value == "\s"){
            alert("비밀번호에는 공백을 사용할 수 없습니다.");
            pwd.focus();
            return false;
        };
        if(reg_kor.test(pwd.value)){
            alert("비밀번호에 한글은 사용 할 수없습니다.");
            pwd.focus();
            return false;
        };
        

        /* repwd */
        if(pwd.value != repwd.value){
            alert("비밀번호를 확인하세요.");
            repwd.focus();
            return false;
        };

        /* birthday */
        if(birthday.value == ""){
            alert("생년월일을 입력하세요.");
            birthday.focus();
            return false;
        };
        if(birthday.value == "\s"){
            alert("생년월일을 공백없이 입력하세요.");
            birthday.focus();
            return false;
        };
        if(!reg_num.test(birthday.value)){
            alert("생년월일은 숫자만 입력해주세요.");
            birthday.focus();
            return false;
        };
        var len = birthday.value.length;
        if(len < 8 || len > 8){
            alert("생년월일을 입력하세요.");
            birthday.focus();
            return false;
        };

        /* mobile */
        var reg = /[0-9]/;
        if(mobile.value == ""){
            alert("휴대폰번호를 입력하세요.");
            mobile.focus();
            return false;
        };
        if(mobile.value == "\s"){
            alert("휴대폰번호는 공백없이 입력하세요.");
            mobile.focus();
            return false;
        };
        if(!reg.test(mobile.value)){
            alert("휴대폰번호에는 특수문자를 사용할 수 없습니다");
            mobile.focus();
            return false;
        };

        /* email */
        if(email_id.value == ""){
            alert("이메일을 입력하세요.");
            email_id.focus();
            return false;
        };
        if(email_id.value == "\s"){
            alert("이메일은 공백없이 입력하세요.");
            email_id.focus();
            return false;
        };

        var email_dns =document.getElementById("email_dns");
        var email_sel =document.getElementById("email_sel");
        if(email_dns.value == ""){
            alert("이메일을 선택하세요.");
            email_sel.focus();
            return false;
        }

        /* gender */
        if(!male.checked && !female.checked){
            alert("성별을 체크해주세요.");
            male.focus();
            return false;
        };
        frm.submit();
    };

    /* email select */
    function change_email(){
        var email_dns =document.getElementById("email_dns");
        var email_sel =document.getElementById("email_sel");

        var idx = email_sel.options.selectedIndex;
        var val = email_sel.options[idx].value;

        email_dns.value = val;
        if(idx == 0){email_dns.focus();};
    };
    function form_back(){
        location.href="../index.php"
    };
    function del_id(idx){
        var n = confirm('회원을 삭제 하시겠습니까?');
        if(n){
            location.href="mgr_member_delete.php?idx="+idx;
        };
    };
    </script>
</head>
<body>
    <form action="mgr_member_edit_ok.php" name="join_form" method="post">
        <fieldset>
            <legend>정보수정</legend>
                
                <p>
                    이름
                    <?php echo $array["uname"]?>
                    <input type="hidden" name="uname" id="uname" value="<?php echo $array["uname"]?>">
                </p>

                <p>
                    아이디
                    <?php echo $array["uid"]?>
                    <input type="hidden" name="idx" id="idx" value="<?php echo $idx ?>">
                </p>

                <p>
                    <label for="pwd">비밀번호</label>
                    <input type="password" name="pwd" id="pwd" maxlength="16">
                </p>

                <p>
                    <label for="repwd">비밀번호확인</label>
                    <input type="password" name="repwd" id="repwd" maxlength="16">
                </p>

                <p>
                <label for="birthday">생년월일</label>
                <input type="text" name="birthday" id="birthday" value="<?php echo $birth[0].$birth[1].$birth[2];?>">
                </p>

                <p>
                <label for="mobile">휴대폰번호</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo $array["mobile"]?>">
                </p>

                <p>
                <label for="email_id">이메일</label>
                <input type="text" name="email_id" id="email_id" value="<?php echo $email[0];?>">@
                <input type="text" name="email_dns" id="email_dns" value="<?php echo $email[1];?>">

                <select name="email_sel" id="email_sel" onchange="change_email()">
                    <option value="">직접입력</option>
                    <option value="naver.com">naver.com</option>
                    <option value="gmail.com">gmail.com</option>
                </select>
                </p>

                <p>
                성별
                <?php if($array["gender"] == "M"){?>
                    <input type="radio" name="gender" id="male" value="M" checked>
                <label for="male">남</label>
                <?php }else{?>
                    <input type="radio" name="gender" id="male" value="M">
                <label for="male">남</label>
                <?php };?>
                
                <?php if($array["gender"] == "F"){?>
                    <input type="radio" name="gender" id="female" value="F" checked>
                <label for="female">여</label>
                <?php }else{?>
                    <input type="radio" name="gender" id="female" value="F">
                <label for="female">여</label>
                <?php };?>
                </p>

                <button type="button" onclick="form_check(this.form)">정보수정</button>
                <button type="button" onclick="form_back()">돌아가기</button>
                <button type="button" onclick="del_id(<?php echo $array["idx"]; ?>)">회원탈퇴</button>

        </fieldset>
    </form>
                
</body>
</html>
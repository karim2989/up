<?php
    $name1 = $_POST["name1"];
    $name2 = $_POST["name2"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    $tel = $_POST["tel"];
    $adr = $_POST["adr"];
    $cin = $_POST["cin"];
    $bd = $_POST["bd"];

    $conn = new mysqli('localhost', 'root', 'root', 'cabinet');
    if ($conn->connect_error) {
        die("server error: " . $conn->connect_error);
    }
    if ($conn->query("Insert into personne (email,pwd,nom,prenom,naissance,address,tel,cin) values ('".$email."','".hash("md5",$pwd)."','".$name1."','".$name2."','".$bd."','".$adr."','".$tel."','".$cin."')")) {
        $res = $conn->query("select id from personne where email='".$email."' and pwd='".hash("md5",$pwd)."'");
        $id = mysqli_fetch_row($res)[0];
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['pwd'] = $pwd;
        $_SESSION['id'] = $id;
        $conn->query("insert into patient  values ('".$id."','')");
        print($conn->error);
        header('Location: ./index.php');
    }
    else{
        die("error");
    }
    

?>
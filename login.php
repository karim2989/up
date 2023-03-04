<?php
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    $conn = new mysqli('localhost', 'root', 'root', 'cabinet');
    if ($conn->connect_error) {
        die("server error: " . $conn->connect_error);
    }
    $id = -1;
    $res = $conn->query("select id from personne where email='".$email."' and pwd='".hash("md5",$pwd)."'");
    $id = mysqli_fetch_row($res)[0];
    print($conn->error);
    if (isset($id) && $id != -1) {
        print("success ".$id);
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['pwd'] = $pwd;
        $_SESSION['id'] = $id;
        header('Location: ../index.php');
    }
    else{
        die("error");
    }
?>
<?php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    $con = new mysqli('localhost', 'root', 'root', 'cabinet');
    session_start();
    $res =  $con->query("select * from consultation where patient='".$_SESSION['id']."'");
    //print($res->num_rows);
    print("liste des consultations:<table><tr> <td>date</td> <td>temps de debut</td> <td>temps de la fin</td>   </tr>");
    for ($i=0; $i < $res->num_rows; $i++) {
        $x = mysqli_fetch_array($res);
        echo "<tr> <td>".$x[1]."</td> <td>".$x[2]."</td> <td>".$x[3]."</td>   </tr>";
    }
    print("</table>");
    print("<br> demande du consultation:<br>");
    ?>
    <form action="demandeconsult.php" method="POST">
        <input type="text" name="subject" id="">
        <input type="date" name="datedemande" id="">
        <input type="time" name="temps" id="">
        <input type="submit" value="submit">
    </form>
    <form action="submitreview.php" method="POST">
        <input type="text" name="text" id="">
        <input type="submit" value="submit">
    </form>
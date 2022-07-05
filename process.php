<?php 
session_start();

$mysqli = new mysqli('localhost','root','','crud') or  die(mysqli_error($mysqli));

$update = false;
$name = '';
$surname = '';
$email = '';

if (isset($_POST['save'])){
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];

    $mysqli->query("INSERT INTO data (Name,LastName,Email) VALUES('$firstName','$lastName','$email')") or
            die($mysqli->error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}




if (isset($_GET['edit'])){
     $id = $_GET['edit'];
     $update = true;
     $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die ($mysqli->error());
     if($result->num_rows){
         $row = $result->fetch_array();
         $name = $row['Name'];
         $surname= $row['LastName'];
         $email = $row['Email'];
     }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];

    $mysqli->query("UPDATE data SET Name='$firstName', LastName='$lastName', Email='$email' WHERE id=$id") or die ($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}


?>



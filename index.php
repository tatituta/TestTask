<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require_once 'process.php'; ?>
<?php if(isset($_SESSION['message'])):?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
  echo $_SESSION['message'];
  unset($_SESSION['message']);
?>
</div>
<?php endif ?>
<div class="container">
<?php
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>
<div class="row justify-content-center">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()):?>
            <tr>
                <td ><?php echo $row['Name']; ?></td>
                <td ><?php echo $row['LastName']; ?></td>
                <td ><?php echo $row['Email']; ?></td>
                <td>
                <a href="index.php?edit=<?php echo $row['Id'];?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['Id'];?>" class="btn btn-danger">Delete</a>

                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php
    function pre_r( $array ) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>
<div class="d-flex justify-content-center">
    <form action="process.php" method="POST" id="ContactForm">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
        <label>First Name</label>
        <input id="name" type="text" name="fname" value="<?php echo $name;?>" placeholder="Enter your name" required class="form-control">
        </div>
        <div class="form-group">
        <label>Last Name</label>
        <input id="lastName" type="text" name="lname"  value="<?php echo $surname;?>" placeholder="Enter your Last name" required class="form-control">
        </div>
        <div class="form-group">
        <label>Email</label>
        <input id="Email" type="email" name="email" value="<?php echo $email;?>" placeholder="Enter Email"  required class="form-control">
        </div>
        <div class="form-group">
        <?php if($update == true): ?>
         <input id="submit" type="submit" name="update" class="btn btn-info" value="Update">
        <?php else: ?>
         <input id="submit" type="submit" name="save" class="btn btn-primary" value="Submit">
      <?php endif; ?>
        </div>
        <div class="show"></div>
    </form>
</div> 
</div> 
</body>
</html>
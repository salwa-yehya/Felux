<?php
require('config.php');
 
  if (isset($_POST['Submit']) ) {
    $user_email=$_POST['email'];
    $user_name=$_POST['name'];
    $user_password=$_POST['password'];
    $confirm=$_POST['confirm'];


// to join all if conditions togather  "flags"
  $one =0;
  $two =0;
  $three =0;
  $four =0;

  $errorName ="";
  $errorPassword ="";
  $errorCPassword ="";
  $errorEmail ="";
  

//Email 
if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty ($_POST['email'])) {
  $user_email=$_POST['email'];
  $one = 1;
 }

else {
 $errorEmail = "Uncorrect ";
}

//Name
 if(preg_match("/^[A-Z a-z]+$/" ,$_POST['name']) && !empty($_POST['name'])) {
  $user_name=$_POST['name'];
  $two = 1;
 }
else {
 $errorName = "not alphabit";
}



// password
//Minimum eight characters, at least one letter, one number and one special character:
if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/" ,$_POST['password']) && !empty($_POST['password'])) {
  $three =1;
 }
else {
 $errorPassword= "Week Password";
}


// Comfirm password
if( $_POST['password'] == $_POST['confirm']) {
  $four = 1;
 }
else {
 $errorCPassword= "Not Match";
}


// send data after submit
if ($one ==1 && $two ==1 && $three ==1 && $four ==1 ){
   $sql=" INSERT INTO users (user_id,user_name,user_email,user_password) 
   VALUES (NULL,:name,:email,:password)";
   $statement =  $con->prepare($sql);
 //binding : bind Varible with query   اربط المتغير مع القيمة
   $statement->bindValue(':name' ,$user_name);
   $statement->bindValue(':email' , $user_email);
   $statement->bindValue(':password' ,$user_password);
  
   $statement-> execute();    
   header("location:login.php");
   exit;
   echo "success";
  } 
  else {
    echo "Not success";
}


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Sign up</title>
    <style><?php include('style.css')?></style>
</head>
<body>

  <div class="wel">
    <h1>Sign Up</h1>
    <p>Create Account , its free</p>
    </div>
    <form action="" method="POST">
<div class="form_lebal">
    <input type="text" class="form-control" name="name" placeholder="Your Name" ><br>
    <?php if(!empty ($errorName)){
       echo " <p id='ahmad'>$errorName</p>" ;
    }
   
    ?>
  </div>
  <div class="form_lebal">
    <input type="email" class="form-control" name="email" placeholder="Your Email" ><br>
    <?php if(!empty ($errorEmail)){
       echo "<p id='ahmad'>$errorEmail</p>"; 
    }
    ?>
  </div>
  

  <div class="form_lebal">
    <input type="password" class="form-control" name="password" placeholder="Enter Password"><br>
    <?php if(!empty ($errorPassword)){
       echo " <p id='ahmad'>$errorPassword</p>" ;
    }
    ?>
  </div>
  <div class="form_lebal">
    <input type="password" class="form-control" name="confirm" placeholder="Confirm Password">
    <?php if(!empty ($errorCPassword)){
       echo " <p id='ahmad'>$errorCPassword</p>" ;
    }
    ?>
    <br>
  </div>

  <input class="btn  col-3 mx-auto icon"  type="Submit" name="Submit" value="SignUp" ><br>
  <!-- <button type="button" class="btn btn-danger col-3 mx-auto icon" >Sign Up</button><br> -->
  <p class="wel" id="link" >Already have an account? <a href="login.php">log in</a></p>
</form>
</body>
</html>
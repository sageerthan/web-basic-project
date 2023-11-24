<?php
   include "connect.php";
   if(isset($_POST['submit']))
   {
      $name = mysqli_real_escape_string($conn,$_POST['name']);
      $email= mysqli_real_escape_string($conn,$_POST['email']);
      $pass=  md5($_POST['password']);
      $cpass= md5($_POST['cpassword']);
      $user_type=$_POST['user_type'];

      $sql="SELECT * FROM user_form WHERE email='$email' AND password='$pass'  ";

      $result = mysqli_query($conn,$sql);

      if(mysqli_num_rows($result) >0 )
      {
        $error[]='user already exist!';
      }
      else
      {
         if($pass != $cpass)
         {
            $error[]='password not matched';
         }
         elseif(empty($name))
         {
            $error[]= 'please enter the name';
         }
         else{
            $insert= "INSERT INTO user_form(name,email,password,user_type) VALUES ('$name','$email','$pass','$user_type')";
           mysqli_query($conn,$insert);
           header("Location:login.php");
         }
      }

   }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <div class="form-container">
        <form action="" method="post">
        <h3>Register Now</h3>
        <?php
           if(isset($error))
           {
            foreach($error as $error)
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
           }
        ?>
        <input type="text" name="name" placeholder="enter your name"><br>
        <input type="email" name="email" placeholder="enter your email"><br>
        <input type="password" name="password" placeholder="enter your password"><br>
        <input type="password" name="cpassword" placeholder="confirm your password"><br>

        <select name="user_type">
           <option value="user">user</option>
           <option value="admin">admin</option>
        </select><br>
        <input type="submit" name="submit" value="register now" class="form-btn"><br>
        <p> already have an account?<a href="login.php">Login now</a></p>
        </form>
</body>
</html>
<?php
   session_start();
   include "connect.php";

   if(isset($_POST['submit']))
   {
      
      $email= mysqli_real_escape_string($conn,$_POST['email']);
      $pass=  md5($_POST['password']);
     

      $sql="SELECT * FROM user_form WHERE email='$email' AND password='$pass'  ";

      $result = mysqli_query($conn,$sql);

      if(mysqli_num_rows($result) >0 )
      {
        $row=mysqli_fetch_array($result);

        if($row['user_type']=='admin')
        {
            $_SESSION['admin_name']=$row['name'];
            header('Location:admin_page.php');
        }
        elseif($row['user_type']=='user')
        {
            $_SESSION['user_name']=$row['name'];
            header('Location:user_page.php');
        }
        
      }
      else
        {
            $error[]='incorrect email or password!';
        }

   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <div class="form-container">
        <form action="" method="post">
        <h3>Login Now</h3>
        <?php
           if(isset($error))
           {
            foreach($error as $error)
            {
               echo '<span class="error-msg">'.$error.'</span>';
            }
           }
        ?>
        <input type="email" name="email" placeholder="enter your email"><br>
        <input type="password" name="password" placeholder="enter your password"><br>
        <input type="submit" name="submit" value="Login now" class="form-btn"><br>
        <p> Don't have an account?<a href="register_form.php">Register now</a></p>
        </form>
</body>
</html>
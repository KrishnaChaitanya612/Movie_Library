<!-------------------------------------------- Security ------------------------------------------->

<?php
include_once "database.php";
session_start();
 $email = isset($_SESSION['email']);
 echo "<script> var base_url = <?php echo $base_url; ?>; </script>";
    if(!$email)
    {
        echo"<script> 
        
        href.location = `${base_url}/login.php`;</script>";
    }  
    else{
        echo"<script>
        
        location.href = `${base_url}/index.php`;</script>";
    }  
?>
<!DOCTYPE html>
<html lang="en">

<!-------------------------------------------- Header Links ------------------------------------------->

<head>
  <title>MovieLibrary - Login</title>
  <?php require_once 'components/links.php'; ?>
  <link rel="stylesheet" href="assets/loginStyle.css">
</head>
 
<body class="bg-light">
    
<!-------------------------------------------- Alerts ------------------------------------------->

<div class="container mt-5">
       <?php


            if(isset($_SESSION['success']) && $_SESSION['success']!='')
            {
                echo'<div class="alert alert-primary text-center font-weight-bold" role="alert">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status']!='')
            {
                echo'<div class="alert alert-danger text-center font-weight-bold" role="alert">'.$_SESSION['status'].'</div>';
                unset($_SESSION['status']);
            }

            
       

    ?>
    
     <script>
            <?php
            if(isset($_SESSION['test']) && $_SESSION['test']!='')
            {
                $test=$_SESSION['test'];
                echo "var test ='$test';";
                unset($_SESSION['test']);
            }
            ?>
            
    </script>
    <!-------------------------------------------- Form ------------------------------------------->

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card">
        <ul class="nav nav-pills mb-3" id="login-tab" role="tablist">
            <li class="nav-item text-center"> <a class="nav-link active btl" id="login-tableContent" data-toggle="pill" href="#login" role="tab" aria-controls="pills-home" aria-selected="true">Login</a> </li>
            <li class="nav-item text-center"> <a class="nav-link btr" id="signUp-tableContent" data-toggle="pill" href="#signUp" role="tab" aria-controls="pills-profile" aria-selected="false">Signup</a> </li>
        </ul>
        <div class="tab-content" >
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tableContent">
                <div class="form px-4 pt-5">
                    <form action="code.php" method="POST">
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                        <input type="password" name="password" class="form-control mb-5" placeholder="Password" required> 
                        <button type="submit" name="user_login"  class="btn btn-primary btn-block">Login</button> 
                    </form>    
                </div>
            </div>
            <div class="tab-pane fade" id="signUp" role="tabpanel" aria-labelledby="signUp-tableContent">
                <div class="form px-4">
                     <form action="code.php" method="POST">
                        <input type="text" name="name" class="form-control" placeholder="Name" required> 
                        <input type="email" name="email" class="form-control" placeholder="Email" required> 
                        <input type="password" name="password1" class="form-control" placeholder="Password" required> 
                        <input type="password" name="password2" class="form-control" placeholder="Confirm Password" required> 
                        <button type="submit" name="user_signup"  class="btn btn-primary btn-block">Signup</button> 
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-------------------------------------------- Footer ------------------------------------------->

 <?php require_once 'components/footer.php'; ?>
 <script>
     signUp(test);
 </script>
 </body>
<?php

include_once "security.php";


/*-------------------------------------------Login User----------------------------------------*/



 if(isset($_POST['user_login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $query = "SELECT * FROM users  WHERE email='$email' AND password ='$password' ";
    $query_run = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($query_run);
    $count=mysqli_num_rows($query_run);
    if($count==1)
    {

        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['success'] = "Login Success ";
        header("Location: $base_url/index.php");
    }
    else
    {
        $_SESSION['status'] = "Invalid Email / Password ";
        header("Location: $base_url/login.php");
    }
}



/*-------------------------------------------Register User----------------------------------------*/


 if(isset($_POST['user_signup']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if($password1 != $password2){
        $_SESSION['status'] = "Passwords doesn't match ";
        $_SESSION['test']="signUp";
        header("Location: $base_url/login.php");
    }
    else {
        $query1 = "SELECT * FROM users  WHERE email='$email'";
        $query_run1 = mysqli_query($connection,$query1);
        $count1=mysqli_num_rows($query_run1);
        if($count1>0)
        {
            $_SESSION['test']="signUp";
            $_SESSION['status'] = "Email already exsists ";
            header("Location: $base_url/login.php");
        }
        else
        {
            $password = md5($password1);
            $query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password') ";
            $query_run = mysqli_query($connection,$query);
            $_SESSION['success'] = "Registered Successfully! Please Login ";
            header("Location: $base_url/login.php");
        }
    }    
}

/*-------------------------------------------Add movie to user list----------------------------------------*/


 if(isset($_POST['list']))
{
    $poster = $_POST['addPoster'];
    $title = $_POST['addTitle'];
    $imdbID = $_POST['addimdbID'];
    $listName = $_POST['addListName'];
    $email = $_SESSION['email'];
    $access = $_POST['access'];
    
    $query = "SELECT * FROM list  WHERE email='$email' AND list_name ='$listName' LIMIT 1";
    $query_run = mysqli_query($connection,$query);
    $count=mysqli_num_rows($query_run);
    if($count==1){
        $row = mysqli_fetch_assoc($query_run);
        $access = $row['access'];
    }
    $query1 = "INSERT INTO list (list_name,email,access,poster,title,imdbID) VALUES ('$listName','$email','$access','$poster','$title','$imdbID') ";
    $query_run1 = mysqli_query($connection,$query1);
  
    if(!$query_run1)
    {
        $_SESSION['status'] = "Email already exsists ";
        header("Location: $base_url/index.php");
    }
    else
    {
       
        $_SESSION['success'] = "Added to List Successfully!";
        header("Location: $base_url/index.php");
    }
      
}

/*------------------------------------------Change access to Private----------------------------------------*/

if(isset($_POST['private']))
{
    $listName = $_POST['list_name'];
    $email = $_SESSION['email'];

    $query = "UPDATE list SET access='1' WHERE list_name='$listName' AND email='$email'";
    $query_run = mysqli_query($connection,$query);
    if(!$query_run)
    {
        $_SESSION['status'] = "Error occured  ";
        header("Location: $base_url/index.php");
    }
    else
    {
       
        $_SESSION['success'] = "{$listName} Changed to Private Successfully !";
        header("Location: $base_url/index.php");
    }
    
}

/*-------------------------------------------Change access to public----------------------------------------*/


if(isset($_POST['public']))
{
    $listName = $_POST['list_name'];
    $email = $_SESSION['email'];

    $query = "UPDATE list SET access='0' WHERE list_name='$listName' AND email='$email'";
    $query_run = mysqli_query($connection,$query);
    if(!$query_run)
    {
        $_SESSION['status'] = "Error occured  ";
        header("Location: $base_url/index.php");
    }
    else
    {
       
        $_SESSION['success'] = "{$listName} Changed to Public Successfully !";
        header("Location: $base_url/index.php");
    }
    
}

/*-------------------------------------------Logout  User----------------------------------------*/

if(isset($_POST['user_logout']))
{
	session_destroy();
	unset($_SESSION['email']);
	unset($_SESSION['name']);

	header("Location: $base_url/login.php");
	
}

?>
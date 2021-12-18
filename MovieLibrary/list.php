<!-------------------------------------------- Header Links ------------------------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>MovieLibrary - List</title>
  <?php require_once 'components/links.php'; ?>
      <link rel="stylesheet" href="assets/style.css">
    <script src="./assets/index.js"></script>
</head>
<!-------------------------------------------- Security ------------------------------------------->

<?php
include_once "database.php";
session_start();
error_reporting(E_ERROR | E_PARSE);
$name = $_GET['list_name'];
$query1 = "SELECT * FROM list WHERE list_name='$name' LIMIT 1";
$query_run1 = mysqli_query($connection,$query1);
$row1=mysqli_fetch_assoc($query_run1);
$access = $row1['access'];
$email =urldecode($_GET['author']);
if($access == '1' && (is_null($_SESSION['email']) || $_SESSION['email'] != $email )){
     ?>
     <div class="container my-5 heading">
       <h5 class="mb-3"> <a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back </a></h5> 
    </div>
     <div class="container text-center justify-content-center">
                    <h4 class="font-weight-bold text-light"> Oops..You don't have access to this list </h4>
     </div>
     <?php
}
else{
?>
<body>

    <!-------------------------------------------- Nav-Bar ------------------------------------------->

  <?php require_once 'components/navbar.php'; ?>
              

  <!-------------------------------------------- List - Movies ------------------------------------------->


    <div class="container my-5 heading">
       <h5 class="mb-3"> <a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back </a></h5> 
        <h4><i class="fa fa-list"></i>&nbsp;Your List - <?php echo $_GET['list_name'] ?></h4>                                    
    </div>
    
    <div class="container">
        <div class="row">
        <?php 
            $name = $_GET['list_name'];
            $query = "SELECT * FROM list WHERE list_name='$name'";
            $query_run = mysqli_query($connection,$query);
               
            if(mysqli_num_rows($query_run) > 0){
                while($row = mysqli_fetch_assoc($query_run)){
                    
        ?>
        <script>
            <?php
                $imdb=$row['imdbID'];
                echo "var imdbID ='$imdb';";
            ?>
        </script>

        <div class="col-md-3">
            <div class="card my-card card-01 height-fix" >
                <img class="card-img-top" src="<?php echo $row['poster'] ?>"/>
                <div class="card-img-overlay">
                    <h5 class="card-title"><strong><?php echo $row['title'] ?></strong></h5>                         
                    <a onclick="movieSelected(imdbID)" class="btn btn-outline-light" href="#">Movie Details</a>
                </div>       
            </div>
        </div>
        <?php 
                }
            }
        ?>
        </div>
    </div>
        
        
<!-------------------------------------------- Footer ------------------------------------------->


 <?php require_once 'components/footer.php'; }?>
</body>
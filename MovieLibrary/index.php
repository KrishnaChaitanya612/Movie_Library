<?php

require_once 'security.php';

?>
<!DOCTYPE html>
<html lang="en">
<!-------------------------------------------- Header Links ------------------------------------------->

<head>
  <title>MovieLibrary - Home</title>
  <?php require_once 'components/links.php'; ?>
    <script src="./assets/index.js"></script>
</head>
<body>
<!-------------------------------------------- Nav-Bar ------------------------------------------->


  <?php require_once 'components/navbar.php'; ?>


<!-------------------------------------------- Alerts ------------------------------------------->

  <div class="container my-4">
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
</div>

<!-------------------------------------------- Add to List Model ------------------------------------------->


<div class="modal fade" id="addList" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add to your List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
        <div class="modal-body">
            <p class="my-3 font-weight-bold">Movie Name : <span id="movieName"></span> </p>
            <form action="code.php" method="POST">
                <input type="hidden" name="addPoster" id="addPoster" class="form-control" required>
                <input type="hidden" name="addTitle" id="addTitle" class="form-control" required>       
                <input type="hidden" name="addimdbID" id="addimdbID"  class="form-control"  required> 
            <?php
                $email = $_SESSION['email'];
                $query = "SELECT DISTINCT list_name FROM list WHERE email='$email'";
                $query_run = mysqli_query($connection,$query);
                if(mysqli_num_rows($query_run) > 0){
             ?>
             <div class="ml-4 my-3">
                 <button type="button" class="btn btn-toggle " onclick="toggle()" data-toggle="button" aria-pressed="false" autocomplete="off">
                <div class="handle"></div></button>
             </div>
             <div class="form-group" id="hide2">
                <label>Select list :</label>
                <select class="form-control" name="addListName" id= "addListName2" >
                    <?php
                         while($row = mysqli_fetch_assoc($query_run))
       {
                    ?>
                    <option><?php echo $row['list_name'] ?></option>
                    <?php }?>
                </select>
            </div>
            <?php 
                }
            ?>
            <div class="form-group" id="hide1">
                <label>Create New List</label>
                <input type="text" name="addListName" id="addListName1"  class="form-control" placeholder="Enter Name of your List " required>
            </div> 

            <div id="access" class="my-3">
                <h5>Privacy</h5>
                <div class="form-check-inline">
                    <label class="form-check-label" >
                        <input type="radio" class="form-check-input" id="public" name="access" value="0" checked>Public
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" >
                        <input type="radio" class="form-check-input" id="private" name="access" value="1">Private
                    </label>
                </div>
            </div>
                    
        </div>
        <script>
                  toggle1()
             </script>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="list"  class="btn btn-primary">Add to List</button>
    </div>

                </form>
                </div>
            </div>
            </div>

<!-------------------------------------------- Movie Search ------------------------------------------->


        <div class="container my-5">
            <h4 class="heading"><i class="fa fa-search"></i>&nbsp; Search Movie</h4>                                    
        </div>
        <div class="container mb-4 ">
                <h3 class="text-center text-light">Hi <?php echo $_SESSION['name']; ?>, Search For Any Movie</h3><br>
                <form id="searchForm">
                    <div class="input-group mb-2 col-md-6 ml-auto mr-auto">
                        <div class="input-group">
                            <input type="text" class="form-control"  id="searchText" placeholder="Search for movie" required>
                            <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            </div>
                        </div>
                        
                    </div>
                </form>      
        </div>
<!-------------------------------------------- Result Movies ------------------------------------------->

        <div class="container">
            <div id="movies" class="row"></div>
        </div>

<!-------------------------------------------- Users Lists ------------------------------------------->
     
        <div class="container my-5">
            <h4 class="heading"><i class="fa fa-list"></i>&nbsp; Your List</h4>                                    
        </div>
        
        <div class="container mb-4">
            <div class="row">
            <?php 
                $email = $_SESSION['email'];
                $query = "SELECT DISTINCT list_name FROM list WHERE email='$email'";
                $query_run = mysqli_query($connection,$query);
               
            if(mysqli_num_rows($query_run) > 0){
                while($row = mysqli_fetch_assoc($query_run)){
                    $listName = $row['list_name'];
        ?>
            <div class="col-md-3 mt-3">
                    <div class="card" >
                        <div class="card-header"><h5 class="card-title" ><?php echo $listName ?></h5></div>
                        <div class="card-body">
                            
                                <?php 

                                $query1 = "SELECT * FROM list  WHERE email='$email' AND list_name ='$listName' LIMIT 1";
                                $query_run1 = mysqli_query($connection,$query1);
                                $row1 = mysqli_fetch_assoc($query_run1);
                                if($row1['access']=='0'){
                                    ?>
                                    <div class="d-flex justify-content-between">
                                    <p> <i class="fa fa-globe" aria-hidden="true"></i>&nbsp; Public</p>
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="list_name" value="<?php echo $row['list_name'] ?>">
                                        <button type="submit" class="btn btn-outline-info" name="private">To Private</button>
                                    </form>
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                   <div class="d-flex justify-content-between">
                                    <p> <i class="fa fa-lock" aria-hidden="true"></i>&nbsp; Private</p>
                                     <form action="code.php" method="POST">
                                        <input type="hidden" name="list_name" value="<?php echo $row['list_name'] ?>">
                                        <button type="submit"  class="btn btn-outline-info" name="public">To Public</button>
                                     </form>
                                </div>
                                    <?php
                                }
                                ?>
                            
                            <form action="list.php" method="GET">
                                <input type="hidden" name="list_name" value="<?php echo $row['list_name'] ?>">
                                <input type="hidden" name="author" value="<?php echo $row1['email'] ?>">
                                <button type="submit" class="btn btn-outline-dark mt-3 ">View List</button>
                            </form>

                        </div> 
                    </div>
                </div>
                <?php }}
                else{?>
                <div class="container text-center">
                    <h4 class="font-weight-bold text-light"> Oops..You don't have any lists </h4>
                </div>
             <?php   }
                ?>
                </div>
        </div>
  
<!-------------------------------------------- Footer ------------------------------------------->

 <?php require_once 'components/footer.php'; ?>
</body>
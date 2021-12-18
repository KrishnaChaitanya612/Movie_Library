<?php

require_once 'security.php';

?>
<!DOCTYPE html>
<html lang="en">
<!-------------------------------------------- Header Links ------------------------------------------->

<head>
  <title>MovieLibrary - Movie</title>
  <?php require_once 'components/links.php'; ?>
</head>

<body>
    
<!-------------------------------------------- Nav-Bar ------------------------------------------->
               
        <?php require_once 'components/navbar.php'; ?>

<!-------------------------------------------- Movie ------------------------------------------->


        <div id="loader"></div>            
        <div class="container pt-4 pb-4">
            <div class="container my-5 heading">
            <h5 class="mb-3"> <a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; Back </a></h5> 
            </div>
            <div id="movie" style="border: none"></div>
        </div>
<!-------------------------------------------- Footer ------------------------------------------->

        <?php require_once 'components/footer.php'; ?>
        <script>
            getMovie();
        </script>

 
</body>
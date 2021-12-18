<nav class="navbar navbar-expand-lg navbar-dark nav-bg justify-content-around ">
    
            <a class="navbar-brand" href="index.php">📽️ Movie Library App</a>
            <?php if($_SESSION['email']){ ?>
            <form action="code.php" method="POST">
                    
                    <button type="submit" name="user_logout" class="nav-link btn btn-light "><i class="fa fa-power-off" aria-hidden="true"></i> &nbsp; Logout</button>
            </form>
            <?php }?>

</nav>
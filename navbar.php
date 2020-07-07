<?php
require_once "requires/session.php";
require_once "requires/PreviousPage.php";

?>
<script>

</script>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="index.php">Belgrade</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="locationList.php">Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="BelgradeHistory.php">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="BelgradeMap.php">Map</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="geography.php">Geography</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="makeTour.php">Make a tour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tourList.php">Tours</a>
            </li>
            <?php
            if (isset($_SESSION['username'])){
                echo "<li class=\"nav-item\">
                <a class=\"nav-link\" href=\"userTours.php\">My tours</a>
            </li>";
            }

            if (isset($_SESSION['admin'])){
                if ($_SESSION['admin']==="daAdminje"){
                    echo "<li class=\"nav-item\">
                <a class=\"nav-link\" href=\"admin\">Admin</a>
            </li>";
                }

            }
            ?>

        </ul>
        <ul class="navbar-nav " >
            <li class="nav-item">

                <a class="nav-link" href="#">
                    <abbr title="Weather in Belgrade" class="text-decoration-none">
                    <span id="temp" style="font-size: x-large "></span>
                    <img class="d-inline" src="" id="icon" alt="icon">
                    </abbr>
                </a>

            </li>

        </ul>
    </div>

    <?php
    //require_once "requires/session.php";
    if (!isset($_SESSION['username'])){
        echo "<div>
        <a href='logIn.php' class='btn btn-primary'>Log in</a>
        
        <a href='signUp.php' class='btn btn-primary'>Sign Up</a>
        
        </div> ";
    }
    else {
        //$username = $_SESSION['username'];
        echo "<div>
        
        <a href='signOut.php' class='btn btn-primary'>Sign Out</a>
        
        </div> ";
    }

    ?>
</nav>

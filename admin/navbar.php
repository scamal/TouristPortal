<?php
require_once "../requires/session.php";
require_once "../requires/PreviousPage.php";
getUri();
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" href="../index.php">Belgrade</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="users.php">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="locations.php">Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="stats.php">View Stats</a>
            </li>

            </li>

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
        <a href='../logIn.php' class='btn btn-primary'>Log in</a>
        
        <a href='../signUp.php' class='btn btn-primary'>Sign Up</a>
        
        </div> ";
    }
    else {
        //$username = $_SESSION['username'];
        echo "<div>
        
        <a href='../signOut.php' class='btn btn-primary'>Sign Out</a>
        
        </div> ";
    }

    ?>
</nav>
